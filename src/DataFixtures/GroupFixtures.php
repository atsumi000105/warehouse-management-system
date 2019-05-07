<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Supplier;
use App\Entity\Warehouse;
use Doctrine\Common\Persistence\ObjectManager;

class GroupFixtures extends BaseFixture
{
    public function loadData(ObjectManager $em)
    {
        $sysAdmin = new Group();
        $sysAdmin->setName('System Administrator');
        $sysAdmin->setRoles(Group::AVAILABLE_ROLES);
        $em->persist($sysAdmin);
        $this->setReference('group_system_administrator', $sysAdmin);

        $bankManager = new Group();
        $bankManager->setName('Manager');
        $bankManager->setRoles(Group::AVAILABLE_ROLES);
        $em->persist($bankManager);
        $this->setReference('group_manager', $bankManager);

        $volunteer = new Group();
        $volunteer->setName('Volunteer');
        $volunteer->setRoles([
            Order::ROLE_EDIT,
            Order::ROLE_VIEW_ALL,
            Product::ROLE_VIEW,
            Supplier::ROLE_VIEW,
            Supplier::ROLE_EDIT,
            Warehouse::ROLE_VIEW,
        ]);
        $em->persist($volunteer);
        $this->setReference('group_volunteer', $volunteer);

        $em->flush();
    }
}
