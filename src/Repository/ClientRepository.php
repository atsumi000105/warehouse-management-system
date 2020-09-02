<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientRepository extends EntityRepository
{
    public function findOneByUuid(string $id): ?Client
    {
        try {
            $uuid = Uuid::fromString($id);
        } catch (InvalidUuidStringException $exception) {
            throw new NotFoundHttpException(sprintf('Invalid Client ID: %s', $id));
        }
        return $this->findOneBy(['uuid' => $uuid]);
    }

    public function findByUuids(array $ids): ?ArrayCollection
    {
        $uuids = array_map(function ($id){
            try {
                $uuid = Uuid::fromString($id);
            } catch (InvalidUuidStringException $exception) {
                throw new NotFoundHttpException(sprintf('Invalid Client ID: %s', $id));
            }
            return $uuid;
        }, $ids);

        $clients = $this->findBy(['uuid' => $uuids]);
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
            $qb->orderBy($sortField, $sortDirection);
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

    protected function addCriteria(QueryBuilder $qb, ParameterBag $params)
    {
        if ($params->has('keyword') && $params->get('keyword')) {
            $qb->andWhere('c.name.lastname LIKE :keyword OR c.name.firstname LIKE :keyword')
                ->setParameter('keyword', '%' . $params->get('keyword') . '%');
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
