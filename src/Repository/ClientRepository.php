<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\EAV\Attribute;
use App\Entity\EAV\ClientAttributeDefinition;
use App\Entity\Partner;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\QueryBuilder;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\VarDumper\VarDumper;

class ClientRepository extends BaseRepository
{
    const ARRAY_MIXED_OPERANDS = [
        'between',
        'not between',
    ];

    public function findOneByPublicId(string $id): ?Client
    {
        /** @var Client|null $client */
        $client = $this->findOneBy(['publicId' => $id]);
        return $client;
    }

    public function findByPublicIds(array $ids): ?ArrayCollection
    {
        $clients = $this->findBy(['publicId' => $ids]);
        return new ArrayCollection($clients);
    }

    public function findDuplicates(ParameterBag $params): ?ArrayCollection
    {
        $qb = $this->createQueryBuilder('c');

        $qb->andWhere('LOWER(c.name.firstname) LIKE :firstname')
            ->andWhere('LOWER(c.name.lastname) LIKE :lastname')
            ->setParameter('firstname', strtolower($params->get('firstname')))
            ->setParameter('lastname', strtolower($params->get('lastname')));

        $qb->andWhere('c.birthdate = :birthdate')
            ->setParameter('birthdate', $params->get('birthdate'));

        if ($params->has('attributes')) {
            /** @var array $attributes */
            $attributes = $params->get('attributes');

            $qb->leftJoin('c.attributes', 'a');

            foreach ($attributes as $attribute) {
                /** @var ClientAttributeDefinition|null $definition */
                $definition = $this
                    ->getEntityManager()
                    ->getRepository(ClientAttributeDefinition::class)
                    ->find($attribute['definition_id']);

                if (!$definition) {
                    throw new \Exception(sprintf("Couldn't find definition %s", $attribute['definition_id']));
                }

                // TODO: Figure out why doing the negative of this and a continue gives a 500 error
                if ($definition->isDuplicateReference()) {
                    $alias = 'a' . $attribute['definition_id'];

                    // TODO Fix this
                    $qb->leftJoin(
                        Attribute::getValueClassFromDefinition($definition),
                        $alias,
                        'WITH',
                        "$alias.attribute = a.id"
                    );

                    $qb->andWhere($alias . '.value = :attribute_value')
                        ->setParameter('attribute_value', $attribute['value']);
                }
            }

            $qb->setMaxResults(5);
        }

        $clients = $qb->getQuery()->execute();

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

    public function findAllCount(ParameterBag $params): int
    {
        $qb = $this->createQueryBuilder('c')
            ->select('count(c)');

        $this->addCriteria($qb, $params);

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @return array|ArrayCollection
     */
    public function findLimitedSearch(ParameterBag $params, string $sortField = null, string $sortDirection = 'ASC')
    {
        $qb = $this->createQueryBuilder('c');
        $this->joinRelatedTables($qb);

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

        $qb->setMaxResults(5);

        return $qb->getQuery()->execute();
    }

    protected function addCriteria(QueryBuilder $qb, ParameterBag $params)
    {
        if ($params->has('keyword') && $params->get('keyword')) {
            $qb->andWhere('lower(c.name.lastname) LIKE :keyword 
                    OR lower(c.name.firstname) LIKE :keyword
                    OR lower(c.parentFirstName) LIKE :keyword
                    OR lower(c.parentLastName) LIKE :keyword')
                ->setParameter('keyword', '%' . strtolower($params->get('keyword')) . '%');
        }

        if ($params->has('birthdate')) {
            $qb->andWhere('c.birthdate = :birthdate')
                ->setParameter('birthdate', $params->get('birthdate'));
        }

        if ($params->has('status')) {
            $qb->andWhere('c.status = :status')
                ->setParameter('status', $params->get('status'));
        }

        if ($params->has('partner')) {
            $qb->andWhere('c.partner = :partner')
                ->setParameter('partner', $params->get('partner'));
        }

        if ($params->has('partnerType')) {
            $qb->leftJoin('c.partner', 'p');

            $qb->andWhere('p.partnerType = :partnerType');

            if ($params->get('partnerType') == Partner::TYPE_AGENCY) {
                $qb->setParameter('partnerType', Partner::TYPE_AGENCY);
            }

            if ($params->get('partnerType') == Partner::TYPE_HOSPITAL) {
                $qb->setParameter('partnerType', Partner::TYPE_HOSPITAL);
            }
        }

        if ($params->has('ageExpirationValue') && $params->has('ageExpirationOperand')) {
            $operand = $params->get('ageExpirationOperand');

            if (! in_array($operand, self::ARRAY_MIXED_OPERANDS)) {
                $qb->andWhere('c.ageExpiresAt' . $operand . ':ageExpiresAtValue');
            } else if (in_array($operand, self::ARRAY_MIXED_OPERANDS) && ($params->has('ageExpiresAtValueTwo'))) {
                $qb->andWhere('c.ageExpiresAt ' . $operand . ' :ageExpiresAtValue AND :ageExpiresAtValueTwo');

                $qb->setParameter('ageExpiresAtValue', $params->get('ageExpiresAtValueTwo'));
            }

            $qb->setParameter('ageExpiresAtValue', $params->get('ageExpirationValue'));
        }

        if ($params->has('distributionExpirationValue') && $params->has('distributionExpirationOperand')) {
            $operand = $params->get('distributionExpirationOperand');

            if (! in_array($operand, self::ARRAY_MIXED_OPERANDS)) {
                $qb->andWhere('c.distributionExpiresAt' . $operand . ':distributionExpiresAtValue');
            } else if (in_array($operand, self::ARRAY_MIXED_OPERANDS) && ($params->has('distributionExpiresAtValueTwo'))) {
                $qb->andWhere('c.distributionExpiresAt ' . $operand . ' :distributionExpiresAtValue AND :distributionExpiresAtValueTwo');

                $qb->setParameter('distributionExpiresAtValue', $params->get('distributionExpiresAtValueTwo'));
            }

            $qb->setParameter('distributionExpiresAtValue', $params->get('distributionExpirationValue'));
        }

        if ($params->has('mergedTo')) {
            $qb->andWhere('c.mergedToClient = :mergedTo');
            $qb->orWhere('c.name LIKE :mergedTo');
            $qb->setParameter('mergedTo', $params->get('mergedTo'));
        }

        /*if ($params->has('zipcode')) {
            $qb->leftJoin('c.attributes', 'ca');
            $qb->leftJoin('ca.definition', 'ad');
            $qb->leftJoin('ca.values', 'av');
            $qb->leftJoin('av.ZipCounty', 'zc');

            $qb->andWhere('ad.name = :zipcodeAttributeField');
            $qb->setParameter('zipcodeAttributeField', 'guardian_zip');

            $qb->andWhere('av.zipCountyId = :value');
            $qb->setParameter('value', $params->get('zipcode'));
        }*/
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
