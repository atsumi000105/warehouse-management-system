<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class AttributePermissionProcessor
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function assignViewPermissions(array $canView)
    {
        foreach ($canView as $canViewGroup) {

        }
    }

    public function assignWritePermissions(array $canWrite)
    {
        foreach ($canWrite as $canWriteGroup) {

        }
    }
}
