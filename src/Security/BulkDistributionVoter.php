<?php

namespace App\Security;

use App\Entity\Order;
use App\Entity\Orders\BulkDistribution;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BulkDistributionVoter extends Voter
{
    public const EDIT = 'EDIT';
    public const VIEW = 'VIEW';

    protected function supports($attribute, $subject): bool
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        if (!$subject instanceof BulkDistribution) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to `supports()`
        /** @var BulkDistribution $order */
        $order = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($order, $user);
            case self::EDIT:
                return $this->canEdit($order, $user);
            default:
                throw new \LogicException('This code should not be reached!');
        }
    }

    private function canView(BulkDistribution $order, User $user): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($order, $user)) {
            return true;
        }

        // If they have the view all role, they can view
        if ($user->hasRole(Order::ROLE_VIEW_ALL)) {
            return true;
        }

        $activePartner = $user->getActivePartner();

        // If they have the manage own role, have an active partner, and this order is that partner's, they can view
        return $user->hasRole(Order::ROLE_MANAGE_OWN)
            && $activePartner
            && $order->getPartner()->getId() === $activePartner->getId();
    }

    private function canEdit(BulkDistribution $order, User $user): bool
    {
        // Admin can do all the things
        if ($user->isAdmin()) {
            return true;
        }

        // If they have the edit all role, they can edit
        if ($user->hasRole(Order::ROLE_EDIT_ALL)) {
            return true;
        }

        $activePartner = $user->getActivePartner();

        // If they have the manage own role, have an active partner, and this order is that partner's, they can edit
        return $user->hasRole(Order::ROLE_MANAGE_OWN)
            && $activePartner
            && $order->getPartner()->getId() === $activePartner->getId()
            && $activePartner->canPlaceOrders();
    }
}
