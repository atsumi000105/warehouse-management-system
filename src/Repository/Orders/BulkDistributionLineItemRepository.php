<?php

namespace App\Repository\Orders;

use App\Entity\Client;
use App\Entity\Orders\BulkDistribution;
use App\Repository\BaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;

class BulkDistributionLineItemRepository extends BaseRepository
{
    /**
     * @param Client $client
     * @return array|ArrayCollection
     */
    public function getClientDistributionHistory(Client $client)
    {
        $qb = $this->createQueryBuilder('l')
            ->innerJoin(BulkDistribution::class, 'o', Join::WITH, 'l.order = o.id')
            ->andWhere('l.client = :client')
            ->setParameter('client', $client)
            ->orderBy('o.distributionPeriod', 'ASC');

        return $qb->getQuery()->execute();
    }

    public function findAllPaged(
        $page = null,
        $limit = null,
        $sortField = null,
        $sortDirection = 'ASC',
        ParameterBag $params = null
    ) {
        $qb = $this->createQueryBuilder('li');

        $this->joinRelatedTables($qb);

        if ($page && $limit) {
            $qb->setFirstResult(($page - 1) * $limit)
                ->setMaxResults($limit);
        }

        if ($sortField) {
            if (!strstr($sortField, '.')) {
                $sortField = 'li.' . $sortField;
            }
        }

        $this->addCriteria($qb, $params);

        $results = $qb->getQuery()->execute();
        return $results;
    }

    public function addCriteria(QueryBuilder $qb, ParameterBag $params)
    {
        if ($params->has('monthAndYear')) {
            $fromTime = new \DateTime($params->get('monthAndYear') . '-01');
            $fromTime = $fromTime->format('Y-m-d H:m:i');

            $toTime = new \DateTime($fromTime . '  first day of next month');
            $toTime = $toTime->format('Y-m-d H:m:i');

            $qb->andWhere('li.createdAt >= :fromTime')
                ->andWhere('li.createdAt < :toTime')
                ->setParameter('fromTime', $fromTime)
                ->setParameter('toTime', $toTime);

            $qb->orderBy('li.createdAt, li.client');
        }
    }

    public function findAllCount(ParameterBag $params): int
    {
        $qb = $this->createQueryBuilder('li')
            ->select('count(li)');

        $this->addCriteria($qb, $params);

        return $qb->getQuery()->getSingleScalarResult();
    }

    protected function joinRelatedTables(QueryBuilder $qb)
    {
        $qb->leftJoin('li.client', 'client');
    }
}
