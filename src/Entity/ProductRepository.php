<?php

namespace App\Entity;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class ProductRepository extends EntityRepository
{
    public function getWarehouseInventory(Product $product)
    {
        $dql = "SELECT SUM(t.delta) AS balance FROM App\Entity\InventoryTransaction t
            WHERE t.product = ?1
              and t.committed = 1
              and t.storageLocation in (SELECT w FROM App\Entity\Warehouse as w)";

        $inventory = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $product)
            ->getSingleScalarResult();

        return $inventory;
    }

    public function getNetworkInventory(Product $product)
    {
        $dql = "SELECT SUM(t.delta) AS balance FROM App\Entity\InventoryTransaction t
            WHERE t.product = ?1
              and t.committed = 1";

        $inventory = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $product)
            ->getSingleScalarResult();

        return $inventory;
    }

    public function getPartnerInventory(Product $product)
    {
        $dql = "SELECT SUM(t.delta) AS balance FROM App\Entity\InventoryTransaction t
            WHERE t.product = ?1
              and t.committed = 1
              and t.storageLocation in (SELECT w FROM App\Entity\Partner as w)";

        $inventory = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $product)
            ->getSingleScalarResult();

        return $inventory;
    }

    public function findByPartnerOrderable($partnerOrderable = true)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->from('App\Entity\Product', 'p')
            ->join('p.productCategory', 'pc')
            ->where('pc.isPartnerOrderable = :isPartnerOrderable')
            ->setParameter('isPartnerOrderable', (bool) $partnerOrderable);

        $results = $qb->getQuery()->execute();

        return $results;
    }

}