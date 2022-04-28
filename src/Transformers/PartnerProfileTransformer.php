<?php

namespace App\Transformers;

use App\Entity\PartnerProfile;
use App\Entity\User;
use League\Fractal\TransformerAbstract;

class PartnerProfileTransformer extends TransformerAbstract
{
    public $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

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
            'id' => $profile->getId(),
            'createdAt' => $profile->getCreatedAt() ? $profile->getCreatedAt()->format('c') : null,
            'updatedAt' => $profile->getUpdatedAt() ? $profile->getUpdatedAt()->format('c') : null,
        ];
    }

    public function includeAttributes(PartnerProfile $profile)
    {
        return $this->collection($profile->getAttributes()->toArray(), new AttributeTransformer($this->user));
    }
}
