<?php

namespace App\Transformers;

use App\Entity\EAV\Attribute;
use App\Entity\EAV\Definition;
use League\Fractal\TransformerAbstract;

class AttributeTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'options'
    ];

    /**
     * @return array
     */
    public function transform(Attribute $attribute)
    {
        return [
            'id' => (int) $attribute->getId(),
            'definition_id' => (int) $attribute->getDefinition()->getId(),
            'name' => $attribute->getDefinition()->getName(),
            'label' => $attribute->getDefinition()->getLabel(),
            'type' => $attribute->getDefinition()->getType(),
            'helpText' => $attribute->getDefinition()->getHelpText(),
            'displayInterface' => $attribute->getDefinition()->getDisplayInterface(),
            'value' => $attribute->getJsonValue(),
            'orderIndex' => $attribute->getDefinition()->getOrderIndex(),
            'hasOptions' => $attribute->hasOptions(),
        ];
    }

    public function includeOptions(Attribute $attribute)
    {
        $options = $attribute->getDefinition()->getOptions();

        return $this->collection($options, new AttributeDefinitionOptionTransformer);
    }
}
