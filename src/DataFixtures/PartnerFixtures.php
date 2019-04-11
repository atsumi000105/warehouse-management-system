<?php

namespace App\DataFixtures;


use App\Entity\PartnerDistributionMethod;
use App\Entity\PartnerFulfillmentPeriod;
use App\Entity\StorageLocationAddress;
use App\Entity\StorageLocationContact;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Partner;

class PartnerFixtures extends BaseFixture
{
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

        for ($i = 0; $i < 50; $i++) {
            $partner = new Partner($this->faker->company . ' Partner');
            $partner->setPartnerType(Partner::TYPE_AGENCY);
            $partner->setDistributionMethod($this->rand_value($distributionMethods));
            $partner->setFulfillmentPeriod($this->rand_value($periods));
            $partner->addContact($this->createContact(StorageLocationContact::class));
            $partner->setAddress($this->createAddress(StorageLocationAddress::class));

            $manager->persist($partner);
        }

        for ($i = 0; $i < 4; $i++) {
            $hospital = new Partner($this->faker->company . ' Hospital');
            $hospital->setPartnerType(Partner::TYPE_HOSPITAL);
            $hospital->setDistributionMethod($this->rand_value($distributionMethods));
            $hospital->setFulfillmentPeriod($this->rand_value($periods));
            $hospital->addContact($this->createContact(StorageLocationContact::class));
            $hospital->setAddress($this->createAddress(StorageLocationAddress::class));

            $manager->persist($hospital);
        }

        $manager->flush();
    }

    private function rand_value($array)
    {
        shuffle($array);
        return reset($array);
    }
}