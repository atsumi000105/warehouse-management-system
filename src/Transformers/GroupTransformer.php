<?php

namespace App\Transformers;

use App\Entity\Group;
use League\Fractal\TransformerAbstract;

class GroupTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'attributeFieldPermissions'
    ];


    public function transform(Group $group)
    {
        return [
            'id' => (int) $group->getId(),
            'name' => $group->getName(),
            'roles' => $group->getRoles(),
            'createdAt' => $group->getCreatedAt()->format('c'),
            'updatedAt' => $group->getUpdatedAt()->format('c'),
        ];
    }

    public function includeAttributeFieldPermissions(Group $group)
    {
        $attributeFieldPermissions = $group->getAttributeFieldPermissions();

        return $this->collection($attributeFieldPermissions, new AttributeDefinitionPermissionTransformer);
    }
}
