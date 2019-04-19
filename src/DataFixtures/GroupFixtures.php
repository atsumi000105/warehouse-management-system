<?php

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Common\Persistence\ObjectManager;

class GroupFixtures extends BaseFixture
{
    public function loadData(ObjectManager $em)
    {
        $sysAdmin = new Group();
        $sysAdmin->setName('System Administrator');
        $sysAdmin->setRoles(['ROLE_USER', 'ROLE_STUFF']);
        $em->persist($sysAdmin);
        $this->setReference('group_system_administrator', $sysAdmin);

        $bankManager = new Group();
        $bankManager->setName('Manager');
        $bankManager->setRoles(['ROLE_USER', 'ROLE_STUFF']);
        $em->persist($bankManager);
        $this->setReference('group_manager', $bankManager);

        $volunteer = new Group();
        $volunteer->setName('Volunteer');
        $volunteer->setRoles(['ROLE_USER', 'ROLE_STUFF']);
        $em->persist($volunteer);
        $this->setReference('group_volunteer', $volunteer);

        $em->flush();
    }
}
