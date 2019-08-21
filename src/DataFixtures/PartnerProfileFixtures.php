<?php

namespace App\DataFixtures;

use App\Entity\EAV\Attribute;
use App\Entity\EAV\PartnerProfileDefinition;
use App\Entity\PartnerProfile;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Partner;

class PartnerProfileFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            PartnerFixtures::class,
            PartnerProfileAttributeFixtures::class
        ];
    }

    public function loadData(ObjectManager $manager)
    {
        $partners = $manager->getRepository(Partner::class)->findAll();
        $definitions = $manager->getRepository(PartnerProfileDefinition::class)->findAll();

        foreach ($partners as $partner) {
            $profile = new PartnerProfile();
            $profile->setPartner($partner);

            foreach ($definitions as $definition) {
                $attribute = new Attribute();
                $attribute->setDefinition($definition);
                $attribute->setValue('Test123');
                $profile->addAttribute($attribute);
            }
            $manager->persist($profile);
        }

        $manager->flush();
    }
}
