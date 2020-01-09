<?php

namespace App\DataFixtures;

use App\Entity\EAV\Attribute;
use App\Entity\EAV\Definition;
use App\Entity\EAV\Option;
use App\Entity\EAV\PartnerProfileDefinition;
use App\Entity\PartnerProfile;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Partner;

class PartnerProfileAttributeFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $definition = new PartnerProfileDefinition();
        $definition->setName('custom_field_1');
        $definition->setLabel('Custom Field 1');
        $definition->setDescription('This is the first custom field for the partner profile.');
        $definition->setRequired(true);
        $definition->setType(Definition::TYPE_STRING);

        $manager->persist($definition);

        $definition = new PartnerProfileDefinition();
        $definition->setName('custom_text_field');
        $definition->setLabel('Custom Text Field');
        $definition->setDescription('This is a long text field for the partner profile.');
        $definition->setRequired(true);
        $definition->setType(Definition::TYPE_TEXT);

        $manager->persist($definition);

        $definition = new PartnerProfileDefinition();
        $definition->setName('custom_int_field');
        $definition->setLabel('Custom Field 2');
        $definition->setDescription('This is the first custom field for the partner profile.');
        $definition->setRequired(false);
        $definition->setType(Definition::TYPE_INTEGER);

        $manager->persist($definition);

        $definition = new PartnerProfileDefinition();
        $definition->setName('custom_float_field');
        $definition->setLabel('Custom Field 3');
        $definition->setDescription('This is the first custom field for the partner profile.');
        $definition->setRequired(false);
        $definition->setType(Definition::TYPE_FLOAT);

        $manager->persist($definition);

        $definition = new PartnerProfileDefinition();
        $definition->setName('custom_datetime_field');
        $definition->setLabel('Custom Field 4');
        $definition->setDescription('This is the first custom field for the partner profile.');
        $definition->setRequired(false);
        $definition->setType(Definition::TYPE_DATETIME);

        $manager->persist($definition);

        $definition = new PartnerProfileDefinition();
        $definition->setName('custom_option_field');
        $definition->setLabel('Option Field');
        $definition->setDescription('This is an option field with a dropdown selector');
        $definition->setRequired(false);
        $definition->setType(Definition::TYPE_OPTION_LIST);

        for ($i = 1; $i < 5; $i++) {
            $option = new Option();
            $option->setName("Option " . $i);
            $option->setValue('option' . $i);
            $definition->addOption($option);
        }

        $manager->persist($definition);

        $manager->flush();
    }
}
