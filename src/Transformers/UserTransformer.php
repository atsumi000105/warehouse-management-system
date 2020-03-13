<?php

namespace App\Transformers;

use App\Entity\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'groups',
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

}
