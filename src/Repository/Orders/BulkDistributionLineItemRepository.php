<?php

namespace App\Repository\Orders;

use App\Entity\Client;
use App\Entity\EAV\Type\ZipCountyAttributeValue;
use App\Entity\Orders\BulkDistribution;
use App\Entity\Orders\BulkDistributionLineItem;
use App\Repository\BaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;
use Doctrine\ORM\QueryBuilder;
use PhpParser\Node\Param;
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

    public function getClientsServed(ParameterBag $params = null)
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

    protected function addCriteria(QueryBuilder $qb, ParameterBag $params)
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
}
