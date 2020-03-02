<?php

namespace App\Repository;

use App\Entity\PartnerUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartnerUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnerUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerUser[]    findAll()
 * @method PartnerUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartnerUser::class);
    }

    // /**
    //  * @return PartnerUser[] Returns an array of PartnerUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PartnerUser
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
