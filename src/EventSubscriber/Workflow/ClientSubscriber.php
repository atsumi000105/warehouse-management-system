<?php

namespace App\EventSubscriber\Workflow;

use App\Entity\Client;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Workflow\Event\GuardEvent;

class ClientSubscriber implements EventSubscriberInterface
{
    /** @var AuthorizationCheckerInterface */
    protected $checker;

    public function __construct(AuthorizationCheckerInterface $checker)
    {
        $this->checker = $checker;
    }

    public function onTransition(GuardEvent $event): void
    {
        if (!$this->checker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $event->setBlocked(true);
        }
    }

    public function onTransitionActivate(GuardEvent $event): void
    {
        if (!$this->checker->isGranted(Client::ROLE_EDIT_ALL)) {
            $status = $event->getSubject()->getStatus();

            if (
                $status === Client::STATUS_LIMIT_REACHED
                || $status === Client::STATUS_INACTIVE_DUPLICATE
                || $status === Client::STATUS_INACTIVE_BLOCKED
            ) {
                $event->setBlocked(true);
            }

            if (!$this->checker->isGranted(Client::ROLE_MANAGE_OWN)) {
                $event->setBlocked(true);
            }
        }
    }

    public function onTransitionDeactivate(GuardEvent $event): void
    {
        if (!$this->checker->isGranted(Client::ROLE_EDIT_ALL)) {
            $status = $event->getSubject()->getStatus();

            if (
                $status === Client::STATUS_LIMIT_REACHED
                || $status === Client::STATUS_INACTIVE_DUPLICATE
                || $status === Client::STATUS_INACTIVE_BLOCKED
            ) {
                $event->setBlocked(true);
            }

            if (!$this->checker->isGranted(Client::ROLE_MANAGE_OWN)) {
                $event->setBlocked(true);
            }
        }
    }

    public function onTransitionExpire(GuardEvent $event): void
    {
        if (!$this->checker->isGranted(Client::ROLE_EDIT_ALL)) {
            $event->setBlocked(true);
        }
    }

    public function onTransitionDeactivateDuplicate(GuardEvent $event): void
    {
        if (!$this->checker->isGranted(Client::ROLE_EDIT_ALL)) {
            $event->setBlocked(true);
        }
    }

    public function onTransitionDeactivateBlocked(GuardEvent $event): void
    {
        if (!$this->checker->isGranted(Client::ROLE_EDIT_ALL)) {
            $status = $event->getSubject()->getStatus();

            if (
                $status === Client::STATUS_LIMIT_REACHED
                || $status === Client::STATUS_INACTIVE
                || $status === Client::STATUS_INACTIVE_DUPLICATE
            ) {
                $event->setBlocked(true);
            }

            if (!$this->checker->isGranted(Client::ROLE_MANAGE_OWN)) {
                $event->setBlocked(true);
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.client_management.guard' => 'onTransition',
            'workflow.client_management.guard.ACTIVATE' => 'onTransitionActivate',
            'workflow.client_management.guard.BLOCK' => 'onTransitionDeactivateBlocked',
            'workflow.client_management.guard.DEACTIVATE' => 'onTransitionDeactivate',
            'workflow.client_management.guard.DUPLICATE' => 'onTransitionDeactivateDuplicate',
            'workflow.client_management.guard.EXPIRE' => 'onTransitionExpire',
        ];
    }
}
