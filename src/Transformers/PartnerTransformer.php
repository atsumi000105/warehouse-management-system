<?php

namespace App\Transformers;

use App\Entity\Partner;
use App\Entity\PartnerDistributionMethod;
use App\Entity\StorageLocation;
use League\Fractal\TransformerAbstract;

class PartnerTransformer extends StorageLocationTransformer
{
    public function getAvailableIncludes()
    {
        $availableIncludes = parent::getAvailableIncludes();
        $availableIncludes[] = 'users';

        return $availableIncludes;
    }

    public function getDefaultIncludes()
    {
        $defaultIncludes = parent::getDefaultIncludes();
        $defaultIncludes[] = 'fulfillmentPeriod';
        $defaultIncludes[] = 'distributionMethod';
        $defaultIncludes[] = 'profile';

        return $defaultIncludes;
    }


    /**
     * @param Partner $partner
     * @return array
     */
    public function transform(StorageLocation $partner)
    {
        return [
            'id' => (int) $partner->getId(),
            'title' => $partner->getTitle(),
            'status' => $partner->getStatus(),
            'partnerType' => $partner->getPartnerType(),
            'legacyId' => $partner->getLegacyId(),
            'forecastAverageMonths' => $partner->getForecastAverageMonths(),
            'createdAt' => $partner->getCreatedAt()->format('c'),
            'updatedAt' => $partner->getUpdatedAt()->format('c'),
        ];
    }

    public function includeFulfillmentPeriod(Partner $partner)
    {
        return $this->item($partner->getFulfillmentPeriod(), new ListOptionTransformer());
    }

    public function includeDistributionMethod(Partner $partner)
    {
        return $this->item($partner->getDistributionMethod(), new ListOptionTransformer());
    }

    public function includeProfile(Partner $partner)
    {
        return $this->item($partner->getProfile(), new PartnerProfileTransformer());
    }

    public function includeUsers(Partner $partner)
    {
        return $this->collection($partner->getUsers(), new PartnerUserTransformer());
    }
}
