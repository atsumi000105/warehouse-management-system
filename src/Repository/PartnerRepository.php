<?php

namespace App\Repository;

use App\Entity\EAV\Type\ZipCountyAttributeValue;
use Doctrine\ORM\QueryBuilder;
use PhpParser\Node\Param;
use Symfony\Component\HttpFoundation\ParameterBag;

class PartnerRepository extends BaseRepository
{
    public function findAllPaged(
        ?int $page = null,
        ?int $limit = null,
        ?string $sortField = null,
        ?string $sortDirection = 'ASC',
        ParameterBag $params = null
    ): array {
        $qb = $this->createQueryBuilder('p');

        if ($page && $limit) {
            $qb->setFirstResult(($page - 1) * $limit)
                ->setMaxResults($limit);
        }

        if ($sortField) {
            if (!strstr($sortField, '.')) {
                $sortField = 'p.' . $sortField;
            }
            $qb->orderBy($sortField, $sortDirection);
        }

        if ($params) {
            $this->addCriteria($qb, $params);
        }

        return $qb->getQuery()->execute();
    }

    public function findAllCount(ParameterBag $params): string
    {
        $qb = $this->createQueryBuilder('p')
            ->select('count(p)');

        $this->addCriteria($qb, $params);

        return $qb->getQuery()->getSingleScalarResult();
    }

    protected function addCriteria(QueryBuilder $qb, ParameterBag $params): void
    {
        if ($params->has('status') && $params->get('status')) {
            $qb->andWhere('p.status = :status')
                ->setParameter('status', $params->get('status'));
        }

        if ($params->has('id') && $params->get('id')) {
            $qb->andWhere('p.id = :id')
                ->setParameter('id', $params->get('id'));
        }

        if ($params->has('partnerType') && $params->get('partnerType')) {
            $qb->andWhere('p.partnerType = :partnerType')
                ->setParameter('partnerType', $params->get('partnerType'));
        }

        if ($params->has('fulfillmentPeriod') && $params->get('fulfillmentPeriod')) {
            $qb->andWhere('p.fulfillmentPeriod = :fulfillmentPeriod')
                ->setParameter('fulfillmentPeriod', $params->get('fulfillmentPeriod'));
        }

        if ($params->has('distributionMethod') && $params->get('distributionMethod')) {
            $qb->andWhere('p.distributionMethod = :distributionMethod')
                ->setParameter('distributionMethod', $params->get('distributionMethod'));
        }

        /**
         * @TODO! Filter by month as in drupal report - need to clarify from where we take this info
         */
        if ($params->has('monthAndYear')) {

        }

        if ($params->has('zipcode') || $params->has('county') || $params->has('state')) {
            $qb->join('p.clients', 'c');
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
    }
}
