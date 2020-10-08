<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use App\Entity\PartnerDistributionMethod;
use App\Entity\PartnerFulfillmentPeriod;
use App\Entity\StorageLocationAddress;
use App\Entity\StorageLocationContact;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Workflow\Registry;

class PartnerFixtures extends BaseFixture
{
    /** @var Registry */
    protected $workflowRegistry;

    public function __construct(Registry $workflowRegistry)
    {
        $this->workflowRegistry = $workflowRegistry;
    }

    public function loadData(ObjectManager $manager)
    {
        $periods = [
            new PartnerFulfillmentPeriod('Week A'),
            new PartnerFulfillmentPeriod('Week B'),
            new PartnerFulfillmentPeriod('Week C'),
            new PartnerFulfillmentPeriod('Week D'),
        ];

        $distributionMethods = [
            new PartnerDistributionMethod('Pickup'),
            new PartnerDistributionMethod('Delivery'),
        ];

        foreach ($periods as $period) {
            $manager->persist($period);
        }

        foreach ($distributionMethods as $distributionMethod) {
            $manager->persist($distributionMethod);
        }

        $statuses = Partner::STATUSES + [
            Partner::STATUS_ACTIVE,
            Partner::STATUS_ACTIVE,
            Partner::STATUS_ACTIVE,
            Partner::STATUS_ACTIVE,
        ];

        for ($i = 0; $i < 10; $i++) {
            $partner = new Partner($this->faker->company . ' Partner', $this->workflowRegistry);
            $partner->setPartnerType(Partner::TYPE_AGENCY);
            $partner->setStatus($this->randValue($statuses));
            $partner->setDistributionMethod($this->randValue($distributionMethods));
            $partner->setFulfillmentPeriod($this->randValue($periods));
            $partner->addContact($this->createContact(StorageLocationContact::class));
            $partner->setAddress($this->createAddress(StorageLocationAddress::class));

            $manager->persist($partner);
        }

        $numStatuses = count($statuses);
        for ($i = 0; $i < ($numStatuses * 2); $i++) {
            $hospital = new Partner($this->faker->company . ' Hospital', $this->workflowRegistry);
            $hospital->setPartnerType(Partner::TYPE_HOSPITAL);
            $hospital->setStatus($statuses[$i % $numStatuses]);
            $hospital->setDistributionMethod($this->randValue($distributionMethods));
            $hospital->setFulfillmentPeriod($this->randValue($periods));
            $hospital->addContact($this->createContact(StorageLocationContact::class));
            $hospital->setAddress($this->createAddress(StorageLocationAddress::class));

            $manager->persist($hospital);
        }

        $manager->flush();
    }

    private function randValue($array)
    {
        shuffle($array);
        return reset($array);
    }
}
