<?php

namespace App\Transformers;


use App\Entity\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
    ];


    public function transform(Role $role)
    {
        return [
            'id' => (int) $role->getId(),
            'name' => $role->getName(),
            'permissions' => $role->getPermissions(),
            'createdAt' => $role->getCreatedAt()->format('c'),
            'updatedAt' => $role->getUpdatedAt()->format('c'),
        ];
    }

}