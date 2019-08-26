<?php

namespace App\Transformers;

use App\Entity\PartnerProfile;
use League\Fractal\TransformerAbstract;

class PartnerProfileTransformer extends TransformerAbstract
{
    public function getDefaultIncludes()
    {
        $defaultIncludes = parent::getDefaultIncludes();
        $defaultIncludes[] = 'attributes';

        return $defaultIncludes;
    }

    /**
     * @return array
     */
    public function transform(PartnerProfile $profile)
    {
        return [
            'id' => (int) $profile->getId(),
            'attributes' => $profile->getAttributes(),
            'createdAt' => $profile->getCreatedAt()->format('c'),
            'updatedAt' => $profile->getUpdatedAt()->format('c'),
        ];
    }

    public function includeAttributes(PartnerProfile $profile)
    {
        $attributes = $profile->getAttributes();

        return $this->collection($attributes, new AttributeTransformer());
    }

}
