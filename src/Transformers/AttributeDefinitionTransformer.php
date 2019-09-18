<?php

namespace App\Transformers;

use App\Entity\EAV\Definition;
use League\Fractal\TransformerAbstract;

class AttributeDefinitionTransformer extends TransformerAbstract
{
    public function transform(Definition $definition)
    {
        return [
            'id' => (int) $definition->getId(),
            'name' => $definition->getName(),
            'label' => $definition->getLabel(),
            'type' => $definition->getType(),
            'description' => $definition->getDescription(),
            'required' => $definition->getRequired(),
        ];
    }
}
