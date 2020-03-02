<?php

namespace App\Transformers;

use App\Entity\User;
use App\Entity\PartnerUser;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'groups',
        'partners',
    ];

    public function transform(User $user)
    {
        return [
            'id' => (int) $user->getId(),
            'name' => [
                'firstName' => $user->getName()->getFirstname(),
                'lastName' => $user->getName()->getLastname(),
                ],
            'email' => $user->getEmail(),
            'updatedAt' => $user->getUpdatedAt()->format('c'),
        ];
    }

    public function includeGroups(User $user)
    {
        return $this->collection($user->getGroups(), new GroupTransformer());
    }

    public function includePartners(User $user)
    {
        if ($user->getPartners ?? false) {
            $partnerUser = new PartnerUser($user->getEmail());
            $partners = $partnerUser->getPartners();
        } else {
            $partners = [];
        }
        return $this->collection($partners, new PartnerTransformer());
   }
}
