<?php

namespace App\Transformers;

use App\Entity\EAV\Attribute;
use League\Fractal\TransformerAbstract;

class AttributeTransformer extends TransformerAbstract
{
    /**
     * @return array
     */
    public function transform(Attribute $attribute)
    {
        return [
            'id' => (int) $attribute->getId(),
            'name' => $attribute->getDefinition()->getName(),
            'label' => $attribute->getDefinition()->getLabel(),
            'type' => $attribute->getDefinition()->getType(),
            'value' => $attribute->getValue(),
        ];
    }
}
