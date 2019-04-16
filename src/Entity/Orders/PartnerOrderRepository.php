<?php

namespace App\Entity\Orders;

use App\Entity\OrderRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\ParameterBag;

class PartnerOrderRepository extends OrderRepository
{
    protected function joinRelatedTables(QueryBuilder $qb)
    {
        $qb->leftJoin('o.partner', 'partner')
            ->leftJoin('o.warehouse', 'warehouse');
    }

    public function partnerOrderTotals($sortField = null, $sortDirection = 'ASC', ParameterBag $params = null)
    {
        $qb = $this->createQueryBuilder('o')
            ->leftJoin('o.lineItems', 'l')
            ->join('o.partner', 'p');

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

    public function findPartnerOrderTotalsCount(ParameterBag $params)
    {

        $qb = $this->createQueryBuilder('o')
            ->leftJoin('o.lineItems', 'l')
            ->join('o.partner', 'p')
            ->groupBy('o.partner');

        $this->addCriteria($qb, $params);

        $paginator = new Paginator($qb->getQuery());
        return $paginator->count();
    }

    protected function addCriteria(QueryBuilder $qb, ParameterBag $params)
    {
        parent::addCriteria($qb, $params);

        if ($params->has('partner')) {
            $qb->andWhere('o.partner = :partner')
                ->setParameter('partner', $params->get('partner'));
        }

        if ($params->has('product')) {
            $qb->andWhere('l.product = :product')
                ->setParameter('product', $params->get('product'));
        }

        if ($params->has('partnerType')) {
            $qb->andWhere('p.partnerType = :partnerType')
                ->setParameter('partnerType', $params->get('partnerType'));
        }

        if ($params->has('orderPeriod')) {
            $qb->andWhere('o.orderPeriod = :orderPeriod')
                ->setParameter('orderPeriod', $params->get('orderPeriod'));
        }

        if ($params->has('startingAt')) {
            $qb->andWhere('o.orderPeriod >= :startingAt')
                ->setParameter('startingAt', new \DateTime($params->get('startingAt')));
        }

        if ($params->has('endingAt')) {
            $qb->andWhere('o.orderPeriod <= :endingAt')
                ->setParameter('endingAt', new \DateTime($params->get('endingAt')));
        }
    }
}
