<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\ValueObjects\Name;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    public function getDependencies()
    {
        return [
            GroupFixtures::class,
        ];
    }

    public function loadData(ObjectManager $manager)
    {
        foreach ($this->getData() as $userArr) {
            $user = new User();
            $user->setEmail($userArr['email']);
            $user->setName($userArr['name']);
            $user->setGroups($userArr['groups']);
            $user->setPassword('password');

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function getData()
    {
        return [
            [
                'email' => 'andrew@koebbe.com',
                'name' => new Name('Andrew', 'Koebbe'),
                'groups' => [$this->getReference('group_system_administrator')]
            ],
            [
                'email' => 'admin@example.com',
                'name' => new Name('System', 'Admin'),
                'groups' => [$this->getReference('group_system_administrator')]
            ],
        ];
    }
}
