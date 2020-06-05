<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\EAV\ClientDefinition;
use App\Entity\Partner;
use App\Entity\ValueObjects\Name;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Workflow\Registry;

class ClientFixtures extends BaseFixture implements DependentFixtureInterface
{
    /** @var Registry */
    protected $workflowRegistry;

    public function __construct(Registry $workflowRegistry)
    {
        $this->workflowRegistry = $workflowRegistry;
    }

    public function getDependencies()
    {
        return [
            ClientAttributeFixtures::class,
            PartnerFixtures::class
        ];
    }

    protected function loadData(ObjectManager $manager)
    {
        $definitions = $manager->getRepository(ClientDefinition::class)->findAll();

        $statuses = [
            Client::STATUS_CREATION,
            Client::STATUS_ACTIVE,
            Client::STATUS_INACTIVE,
            Client::STATUS_LIMIT_REACHED,
            Client::STATUS_DUPLICATE_INACTIVE,
        ];


        foreach ($this->getData() as $clientArr) {
            $client = new Client($this->workflowRegistry);
            $client->setName($clientArr['name']);
            $client->setPartner($clientArr['partner']);
            $client->setBirthdate($this->faker->dateTimeBetween('-5 years', 'now'));

            $randKey = array_rand($statuses);
            $client->setStatus($statuses[$randKey]);

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
        $clientsToCreate = 500;
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
