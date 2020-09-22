<?php


namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class ZipCountyRepository extends EntityRepository
{
    public function findByZipQuery(string $query)
    {
        $qb = $this->createQueryBuilder('z')
            ->where('z.zipCode like :query')
            ->setParameter('query', $query.'%')
            ->orderBy('z.zipCode', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
