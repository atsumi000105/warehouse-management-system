<?php

namespace App\DataFixtures;

use App\Entity\EAV\Attribute;
use App\Entity\EAV\PartnerProfileDefinition;
use App\Entity\PartnerProfile;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Partner;

class PartnerProfileAttributeFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $definition = new PartnerProfileDefinition();
        $definition->setName('Custom Field 1');
        $definition->setDescription('This is the first custom field for the partner profile.');
        $definition->setRequired(true);
        $definition->setType('string');

        $manager->persist($definition);

        $manager->flush();
    }
}
