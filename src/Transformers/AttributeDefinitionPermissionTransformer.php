<?php

namespace App\Transformers;

use App\Entity\EAV\AttributeDefinitionPermission;
use League\Fractal\TransformerAbstract;

class AttributeDefinitionPermissionTransformer extends TransformerAbstract
{
    public function transform(AttributeDefinitionPermission $attributePermission): array
    {
        return [
            'id' => (int) $attributePermission->getId(),
            'definition_id' => (int) $attributePermission->getDefinition()->getId(),
            'group_id' => $attributePermission->getGroup()->getId(),
            'can_view' => (bool) $attributePermission->getCanView(),
            'can_edit' => (bool) $attributePermission->getCanEdit(),
        ];
    }
}
