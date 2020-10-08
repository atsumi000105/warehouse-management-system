<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;

class ClientRepository extends EntityRepository
{
    public function findOneByPublicId(string $id): ?Client
    {
        return $this->findOneBy(['publicId' => $id]);
    }

    public function findByPublicIds(array $ids): ?ArrayCollection
    {
        $clients = $this->findBy(['publicId' => $ids]);
        return new ArrayCollection($clients);
    }

    public function findAllPaged(
        $page = null,
        $limit = null,
        $sortField = null,
        $sortDirection = 'ASC',
        ParameterBag $params = null
    ) {
        $qb = $this->createQueryBuilder('c');

        $this->joinRelatedTables($qb);

        if ($page && $limit) {
            $qb->setFirstResult(($page - 1) * $limit)
                ->setMaxResults($limit);
        }

        if ($sortField) {
            if (!strstr($sortField, '.')) {
                $sortField = 'c.' . $sortField;
            }

            if ($sortField === 'c.fullName') {
                $qb->orderBy('c.name.firstname', $sortDirection);
                $qb->orderBy('c.name.lastname', $sortDirection);
            } else {
                $qb->orderBy($sortField, $sortDirection);
            }
        }

        $this->addCriteria($qb, $params);

        $results = $qb->getQuery()->execute();
        return $results;
    }

    public function findAllCount(ParameterBag $params)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('count(c)');

        $this->addCriteria($qb, $params);

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @param ParameterBag $params
     * @return array|ArrayCollection
     */
    public function findLimitedSearch(ParameterBag $params)
    {
        $qb = $this->createQueryBuilder('c');
        $this->joinRelatedTables($qb);

        $this->addCriteria($qb, $params);

        $qb->setMaxResults(5);

        return $qb->getQuery()->execute();
    }

    protected function addCriteria(QueryBuilder $qb, ParameterBag $params)
    {
        if ($params->has('keyword') && $params->get('keyword')) {
            $qb->andWhere('lower(c.name.lastname) LIKE :keyword OR lower(c.name.firstname) LIKE :keyword')
                ->setParameter('keyword', '%' . strtolower($params->get('keyword')) . '%');
        }

        if ($params->has('partner')) {
            $qb->andWhere('c.partner = :partner')
                ->setParameter('partner', $params->get('partner'));
        }
    }

    protected function joinRelatedTables(QueryBuilder $qb)
    {
        $qb->leftJoin('c.partner', 'partner');
    }

    /**
     * Returns all clients that are currently active and their age expiration date has passed.
     */
    public function findAllActiveAgedOut()
    {
        $qb = $this->createQueryBuilder('c');

        $qb->andWhere('c.status = :status')
            ->setParameter('status', Client::STATUS_ACTIVE);

        $now = new \DateTimeImmutable();

        $qb->andWhere('c.ageExpiresAt < :now')
            ->setParameter('now', $now);

        return $qb->getQuery()->execute();
    }

    /**
     * Returns all clients that are currently active and their age expiration date has passed.
     */
    public function findAllActiveMaxDistributions()
    {
        $qb = $this->createQueryBuilder('c');

        $qb->andWhere('c.status = :status')
            ->setParameter('status', Client::STATUS_ACTIVE);

        $now = new \DateTimeImmutable();

        $qb->andWhere('c.distributionExpiresAt < :now')
            ->setParameter('now', $now);

        return $qb->getQuery()->execute();
    }
}
