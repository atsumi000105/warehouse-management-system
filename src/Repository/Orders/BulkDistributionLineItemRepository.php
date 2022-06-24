<?php

namespace App\Repository\Orders;

use App\Entity\Client;
use App\Entity\EAV\Type\ZipCountyAttributeValue;
use App\Entity\Orders\BulkDistribution;
use App\Entity\Orders\BulkDistributionLineItem;
use App\Entity\ValueObjects\Name;
use App\Repository\BaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;
use PhpParser\Node\Param;

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
        $qb = $this->createQueryBuilder('l');

        $this->joinRelatedTables($qb);

        if ($page && $limit) {
            $qb->setFirstResult(($page - 1) * $limit)
                ->setMaxResults($limit);
        }

        if ($sortField) {
            if (!strstr($sortField, '.')) {
                $sortField = 'l.' . $sortField;
            }
        }

        $this->addCriteria($qb, $params);

        $results = $qb->getQuery()->execute();
        return $results;
    }

    public function getServedTotalCount(ParameterBag $params)
    {
        $dql = "SELECT COUNT(DISTINCT p.id)
            FROM App\Entity\Orders\BulkDistributionLineItem l
            JOIN App\Entity\Orders\BulkDistribution o with l.order = o.id 
            JOIN o.partner p
            JOIN l.client c
            ";

        return $this->getEntityManager()->createQuery($dql)
            ->getSingleScalarResult();
    }

    public function getClientsServedByMonth(ParameterBag $params = null)
    {
        $qb = $this->createQueryBuilder('l')
            ->select(['p.id', 'p.title', 'COUNT(DISTINCT(c.id)) as clients', 'COUNT(DISTINCT(c.family_id)) as families'])
            ->join(BulkDistribution::class, 'o', Join::WITH, 'l.order = o.id')
            ->join('o.partner', 'p')
            ->join('l.client', 'c');

        $this->addCriteria($qb, $params);

        $qb->groupBy('p.id');

        return $qb->getQuery()->getArrayResult();
    }

    public function getClientsServed(ParameterBag $params = null)
    {
        $qb = $this->createQueryBuilder('l')
            ->select(['p.id', 'p.title', 'COUNT(DISTINCT(c.id)) as clients', 'COUNT(DISTINCT(c.family_id)) as families'])
            ->join(BulkDistribution::class, 'o', Join::WITH, 'l.order = o.id')
            ->join('o.partner', 'p')
            ->join('l.client', 'c');

        $this->addCriteria($qb, $params);

        $qb->groupBy('p.id');

        $mainQuery = $qb->getQuery()->getArrayResult();

        if ($params->has('dateFrom') && $params->has('dateTo')) {
            $dateFrom = new \DateTime($params->get('dateFrom'));
            $dateTo = new \DateTime($params->get('dateTo'));

            $diff = $dateFrom->diff($dateTo);

            $yearsInMonth = $diff->format('%r%y') * 12;
            $months = $diff->format('%r%m');
            $totalMonths = $yearsInMonth + $months;

            for ($i = 0; $i <= $totalMonths; $i++) {
                if ($dateFrom <= $dateTo) {
                    if ($params->has('monthAndYear')) {
                        $params->remove('monthAndYear');
                    }

                    $params->set('monthAndYear', $dateFrom->format('Y-m'));
                    $localMonth = $this->getClientsServedByMonth($params);

                    foreach ($mainQuery as $key => $mainResult) {
                        $mainQuery[$key]['clientsMonth ' . $dateFrom->format('Y-m')] = 0;
                        $mainQuery[$key]['familiesMonth ' . $dateFrom->format('Y-m')] = 0;

                        foreach ($localMonth as $localResult) {
                            if ($mainResult['id'] === $localResult['id']) {
                                $mainQuery[$key]['clientsMonth-' . $dateFrom->format('Y-m')] = $localResult['clients'];
                                $mainQuery[$key]['familiesMonth-' . $dateFrom->format('Y-m')] = $localResult['families'];
                            }
                        }
                    }

                    $dateFrom = $dateFrom->modify('next month');
                }
            }
        }

        return $mainQuery;
    }

    public function addCriteria(QueryBuilder $qb, ParameterBag $params)
    {
        if ($params->has('zipcode') || $params->has('county') || $params->has('state')) {
            $qb->join('c.attributes', 'ca');
            $qb->join('ca.definition', 'ad');

            $qb->andWhere('ad.name = :zipcodeAttributeField');
            $qb->setParameter('zipcodeAttributeField', 'guardian_zip');

            $qb->join(ZipCountyAttributeValue::class, 'zca', 'WITH', 'ca.id = zca.attribute');

            $qb->join('zca.value', 'zc');

            if ($params->has('zipcode')) {
                $qb->andWhere('zc.zipCode = :zipcode');
                $qb->setParameter('zipcode', $params->get('zipcode'));
            }

            if ($params->has('county')) {
                $qb->andWhere('zc.countyName LIKE :county');
                $qb->setParameter('county', '%' . $params->get('county') . '%');
            }

            if ($params->has('state')) {
                $qb->andWhere('zc.stateCode LIKE :state');
                $qb->setParameter('state', '%' . $params->get('state') . '%');
            }
        }

        if ($params->has('monthAndYear')) {
            $fromTime = new \DateTime($params->get('monthAndYear') . '-01');
            $fromTime = $fromTime->format('Y-m-d H:m:i');

            $toTime = new \DateTime($fromTime . '  first day of next month');
            $toTime = $toTime->format('Y-m-d H:m:i');

            $qb->andWhere('l.createdAt >= :fromTime')
                ->andWhere('l.createdAt < :toTime')
                ->setParameter('fromTime', $fromTime)
                ->setParameter('toTime', $toTime);

            $qb->orderBy('l.createdAt');
        }
    }

    public function findAllCount(ParameterBag $params): int
    {
        $qb = $this->createQueryBuilder('l')
            ->select('count(l)');

        $this->addCriteria($qb, $params);

        return $qb->getQuery()->getSingleScalarResult();
    }

    protected function joinRelatedTables(QueryBuilder $qb)
    {
        $qb->leftJoin('l.client', 'client');
    }

    public function getServedClientsInSameMonthCount(ParameterBag $params): int
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l.id')
            ->leftJoin(BulkDistribution::class, 'o', Join::WITH, 'l.order = o.id')
            ->leftJoin('o.partner', 'p')
            ->leftJoin('l.client', 'c');

        $this->addCriteria($qb, $params);

        $qb->groupBy('l.client');
        $qb->having('COUNT(l.client) > 1');

        return count($qb->getQuery()->getArrayResult());
    }

    public function getServedClientsInSameMonth(
        $page = null,
        $limit = null,
        $sortField = null,
        $sortDirection = 'ASC',
        ParameterBag $params = null
    )
    {
        $qb = $this->createQueryBuilder('l');

        $qb->select([
            'l.id',
            'l.createdAt as distributedAt',
            'c.parentFirstName',
            'c.parentLastName',
            'COUNT(l.client) as duplicatedDistributionCount',
            'c.name.firstname as firstname',
            'c.name.lastname as lastname',
        ])
            ->leftJoin(BulkDistribution::class, 'o', Join::WITH, 'l.order = o.id')
            ->leftJoin('o.partner', 'p')
            ->leftJoin('l.client', 'c');

        if ($page && $limit) {
            $qb->setFirstResult(($page-1) * $limit)
                ->setMaxResults($limit);
        }

        if ($sortField) {
            if (!strstr($sortField, '.')) {
                $sortField = 'l.' . $sortField;
            }
        }

        $this->addCriteria($qb, $params);

        $qb->groupBy('l.client');
        $qb->having('COUNT(l.client) > 1');

        return $qb->getQuery()->getArrayResult();
    }
}
