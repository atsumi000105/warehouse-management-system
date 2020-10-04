<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;

class ProductCategoryRepository extends EntityRepository
{
    public function isCategoryEmpty(int $categoryId): bool
    {
        $product = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->join('p.productCategory', 'pc')
            ->andWhere('p.deletedAt IS NULL')
            ->andWhere('pc.id = :categoryId')
            ->setMaxResults(1)
            ->setParameter('categoryId', $categoryId)
            ->getQuery()
            ->getOneOrNullResult();

        return $product === null;
    }
}
