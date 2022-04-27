<?php

namespace App\Transformers;

use App\Entity\Partner;
use App\Entity\StorageLocation;
use App\Entity\User;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class PartnerTransformer extends StorageLocationTransformer
{
    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function getAvailableIncludes(): array
    {
        $availableIncludes = parent::getAvailableIncludes();
        $availableIncludes[] = 'users';
        $availableIncludes[] = 'profile';

        return $availableIncludes;
    }

    public function getDefaultIncludes(): array
    {
        $defaultIncludes = parent::getDefaultIncludes();
        $defaultIncludes[] = 'fulfillmentPeriod';
        $defaultIncludes[] = 'distributionMethod';

        return $defaultIncludes;
    }


    /**
     * @param Partner $partner
     * @return array
     */
    public function transform(StorageLocation $partner): array
    {
        return [
            'id' => (int) $partner->getId(),
            'title' => $partner->getTitle(),
            'fullAddress' => $partner->getFullAddress(),
            'status' => $partner->getStatus(),
            'partnerType' => $partner->getPartnerType(),
            'legacyId' => $partner->getLegacyId(),
            'notes' => $partner->getNotes(),
            'forecastAverageMonths' => $partner->getForecastAverageMonths(),
            'canPlaceOrders' => $partner->canPlaceOrders(),
            'isPublicDisplay' => $partner->getIsPublicDisplay(),
            'createdAt' => $partner->getCreatedAt()->format('c'),
            'updatedAt' => $partner->getUpdatedAt()->format('c'),
        ];
    }

    public function includeFulfillmentPeriod(Partner $partner): Item
    {
        return $this->item($partner->getFulfillmentPeriod(), new ListOptionTransformer());
    }

    public function includeDistributionMethod(Partner $partner): Item
    {
        return $this->item($partner->getDistributionMethod(), new ListOptionTransformer());
    }

    public function includeProfile(Partner $partner): Item
    {
        return $this->item($partner->getProfile(), new PartnerProfileTransformer($this->user));
    }

    public function includeUsers(Partner $partner): Collection
    {
        return $this->collection($partner->getUsers(), new PartnerUserTransformer());
    }

    public function includeContacts(StorageLocation $storageLocation): Collection
    {
        $contacts = $storageLocation->getContacts();

        return $this->collection($contacts, new PartnerContactTransformer());
    }
}
