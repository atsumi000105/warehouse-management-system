<?php

namespace App\Transformers;

use App\Entity\EAV\AttributeOption;
use League\Fractal\TransformerAbstract;

class AttributeDefinitionOptionTransformer extends TransformerAbstract
{
    public function transform(AttributeOption $option)
    {
        return [
            'id' => (int) $option->getId(),
            'name' => $option->getName(),
            'nameEs' => $option->getNameEs(),
            'value' => $option->getValue(),
        ];
    }
}
