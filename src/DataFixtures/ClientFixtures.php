<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\ValueObjects\Name;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ClientFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        foreach ($this->getData() as $clientArr) {
            $client = new Client();
            $client->setName($clientArr['name']);

            $manager->persist($client);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        $clientsToCreate = 75;
        return array_map(
            static function () {
                $faker = Factory::create();
                return ['name' => Name::fromString($faker->name)];
            },
            range(1, $clientsToCreate)
        );
    }
}
