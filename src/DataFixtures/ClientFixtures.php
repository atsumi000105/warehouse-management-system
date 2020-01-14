<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\EAV\ClientDefinition;
use App\Entity\Partner;
use App\Entity\ValueObjects\Name;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ClientFixtures extends BaseFixture
{
    public function getDependencies()
    {
        return [
            ClientAttributeFixtures::class,
            Partner::class
        ];
    }


    protected function loadData(ObjectManager $manager)
    {
        $definitions = $manager->getRepository(ClientDefinition::class)->findAll();


        foreach ($this->getData() as $clientArr) {
            $client = new Client();
            $client->setName($clientArr['name']);
            $client->setPartner($clientArr['partner']);

            foreach ($definitions as $definition) {
                $attribute = $definition->createAttribute();
                $attribute->setValue($attribute->fixtureData());
                $client->addAttribute($attribute);
            }


            $manager->persist($client);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        $clientsToCreate = 200;
        $faker = Factory::create();
        $partners = $this->manager->getRepository(Partner::class)->findAll();


        return array_map(
            static function () use ($faker, $partners) {
                return [
                    'name' => new Name($faker->firstName, $faker->lastName),
                    'partner' => $partners[array_rand($partners)]
                ];
            },
            range(1, $clientsToCreate)
        );
    }
}
