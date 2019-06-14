<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\ValueObjects\Name;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    public function getDependencies(): array
    {
        return [
            GroupFixtures::class,
        ];
    }

    public function loadData(ObjectManager $manager): void
    {
        foreach ($this->getData() as $userArr) {
            $user = new User($userArr['email']);
            $user->setName($userArr['name']);
            $user->setGroups($userArr['groups']);
            $user->setPlainTextPassword('password');

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'email' => 'andrew@koebbe.com',
                'name' => new Name('Andrew', 'Koebbe'),
                'groups' => [$this->getReference('group_system_administrator')],
            ],
            [
                'email' => 'admin@example.com',
                'name' => new Name('Sysadmin', 'User'),
                'groups' => [$this->getReference('group_system_administrator')],
            ],
            [
                'email' => 'manager@example.com',
                'name' => new Name('Manager', 'User'),
                'groups' => [$this->getReference('group_manager')],
            ],
            [
                'email' => 'volunteer@example.com',
                'name' => new Name('Volunteer', 'User'),
                'groups' => [$this->getReference('group_volunteer')],
            ],
        ];
    }
}
