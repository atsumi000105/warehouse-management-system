<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;

class ListOptionRepository extends EntityRepository
{
    public function findOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}
