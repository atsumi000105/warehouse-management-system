<?php

namespace App\Entity\Orders;

use App\Entity\OrderRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\ParameterBag;

class SupplyOrderRepository extends OrderRepository
{
    protected function joinRelatedTables(QueryBuilder $qb)
    {
        $qb->leftJoin('o.supplier', 'supplier')
            ->leftJoin('o.warehouse', 'warehouse');
    }

    public function supplierTotals($sortField = null, $sortDirection = 'ASC', ParameterBag $params)
    {
        $qb = $this->createQueryBuilder('o')
            ->leftJoin('o.lineItems', 'l')
            ->join('o.supplier', 's');

        if ($sortField && $sortField != 'total') {
            if (!str_contains($sortField, '.')) {
                $sortField = 'o.' . $sortField;
            }
            $qb->orderBy($sortField, $sortDirection);
        }

        $this->addCriteria($qb, $params);

        $results = $qb->getQuery()->execute();
        return $results;
    }

    public function findSupplierTotalsCount(ParameterBag $params)
    {

        $qb = $this->createQueryBuilder('o')
            ->leftJoin('o.lineItems', 'l')
            ->join('o.supplier', 's')
            ->groupBy('o.supplier');

        $this->addCriteria($qb, $params);

        $paginator = new Paginator($qb->getQuery());
        return $paginator->count();
    }

    protected function addCriteria(QueryBuilder $qb, ParameterBag $params)
    {
        if ($params->has('supplier')) {
            $qb->andWhere('o.supplier = :supplier')
                ->setParameter('supplier', $params->get('supplier'));
        }

        if ($params->has('product')) {
            $qb->andWhere('l.product = :product')
                ->setParameter('product', $params->get('product'));
        }

        if ($params->has('supplierType')) {
            $qb->andWhere('s.supplierType = :supplierType')
                ->setParameter('supplierType', $params->get('supplierType'));
        }

        if ($params->has('startingAt')) {
            $qb->andWhere('o.createdAt >= :startingAt')
                ->setParameter('startingAt', new \DateTime($params->get('startingAt')));
        }

        if ($params->has('endingAt')) {
            $qb->andWhere('o.createdAt <= :endingAt')
                ->setParameter('endingAt', new \DateTime($params->get('endingAt')));
        }
    }
}
