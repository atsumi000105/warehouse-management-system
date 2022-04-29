<?php

namespace App\Transformers;

use App\Entity\EAV\AttributeDefinition;
use League\Fractal\TransformerAbstract;

class AttributeDefinitionTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'options'
    ];

    public function transform(AttributeDefinition $definition)
    {
        return [
            'id' => (int) $definition->getId(),
            'name' => $definition->getName(),
            'label' => $definition->getLabel(),
            'labelEs' => $definition->getLabelEs(),
            'type' => $definition->getType(),
            'helpText' => $definition->getHelpText(),
            'helpTextEs' => $definition->getHelpTextEs(),
            'displayInterface' => $definition->getDisplayInterface(),
            'description' => $definition->getDescription(),
            'descriptionEs' => $definition->getDescriptionEs(),
            'required' => $definition->getRequired(),
            'options' => $definition->getOptions()->getValues(),
            'orderIndex' => $definition->getOrderIndex(),
            'isDisplayedPublicly' => $definition->getIsDisplayedPublicly(),
        ];
    }

    public function includeOptions(AttributeDefinition $definition)
    {
        $options = $definition->getOptions();

        return $this->collection($options, new AttributeDefinitionOptionTransformer());
    }
}
