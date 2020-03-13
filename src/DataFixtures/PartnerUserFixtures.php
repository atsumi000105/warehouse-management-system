<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use App\Entity\PartnerUser;
use Doctrine\Common\Persistence\ObjectManager;

class PartnerUserFixtures extends BaseFixture
{
    public function getDependencies(): array
    {
        return [
            GroupFixtures::class,
            PartnerFixtures::class,
        ];
    }

    public function loadData(ObjectManager $manager): void
    {
        $partners = $manager->getRepository(Partner::class)->findAll();

        foreach ($partners as $partner) {

            $partnerUser = new PartnerUser('user@'.str_replace(' ', '', $partner->getTitle()).'.com');
            $partnerUser->setPartners([$partner])
                ->setPlainTextPassword('password');

            $manager->persist($partnerUser);

        }

        $manager->flush();
    }
}
