<?php

namespace App\Repository;

use App\Entity\EAV\AttributeDefinitionPermission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AttributeDefinitionPermissionRepository extends BaseRepository
{
    // /**
    //  * @return AttributeDefinitionPermission[] Returns an array of AttributeDefinitionPermission objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findOneByGroupAndDefinition($groupId, $definitionId): ?AttributeDefinitionPermission
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.definition = :definitionId')
            ->andWhere('a.group = :groupId')
            ->setParameters(['groupId' => $groupId, 'definitionId' => $definitionId])
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
