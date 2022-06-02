<?php

namespace App\Repository\Orders;

use App\Entity\Orders\BulkDistribution;
use App\Entity\Partner;
use App\Entity\Product;
use App\Repository\OrderRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\ParameterBag;

class BulkDistributionOrderRepository extends OrderRepository
{
    protected function joinRelatedTables(QueryBuilder $qb)
    {
        $qb->leftJoin('o.partner', 'partner');
    }

    public function getProducts(): array
    {
        $productRepo = $this->getEntityManager()->getRepository(Product::class);

        return $productRepo->findAllProducts();
    }

    private function getReadyToDisplayData(array $data, ?\DateTime $date = null): array
    {
        $availableProducts = $this->getProducts();

        $skuPlusDate = '';
        if ($date) {
            $skuPlusDate = '-'. $date->format('Y-m');
        }

        $finalResult = [];

        foreach ($data as $key => $result) {
            $finalResult[$result['id']]['totals'] = 0;

            foreach ($availableProducts as $product) {
                $finalResult[$result['id']]["{$product['sku']}$skuPlusDate"] = 0;
                $finalResult[$result['id']]['totals' . $skuPlusDate] = 0;
            }
        }

        foreach ($data as $result) {
            $finalResult[$result['id']]['id'] = $result['id'];
            $finalResult[$result['id']]['name'] = $result['name'];
            $finalResult[$result['id']]['type'] = $result['type'];

            foreach ($availableProducts as $product) {
                if ($product['sku'] == $result['sku']) {
                    $finalResult[$result['id']]["{$product['sku']}$skuPlusDate"] = $result['productTotal'];
                    $finalResult[$result['id']]['totals' . $skuPlusDate] = $finalResult[$result['id']]['totals' . $skuPlusDate] + $result['productTotal'];
                }
            }
        }

        return array_values($finalResult);
    }

    public function distributionTotalsPerMonth(ParameterBag $params = null)
    {
        $qb = $this->createQueryBuilder('o')
            ->select([
                'p.id as id',
                'p.title as name',
                'p.partnerType as type',
                'product.sku',
                'product.name as productName',
                'COUNT(l.quantity) as productTotal'
            ])
            ->leftJoin('o.lineItems', 'l')
            ->join('o.partner', 'p')
            ->join('l.product', 'product');

        $params->remove('startingAt');
        $params->remove('endingAt');

        $this->addCriteria($qb, $params);

        $qb->groupBy('p.id, product.id');

        return $qb->getQuery()->getArrayResult();
    }

    public function distributionTotals(
        $page = null,
        $limit = null,
        $sortField = null,
        $sortDirection = 'ASC', ParameterBag $params = null
    )
    {
        $availableProducts = $this->getProducts();

        $qb = $this->createQueryBuilder('o')
            ->select([
                'p.id as id',
                'p.title as name',
                'p.partnerType as type',
                'product.sku',
                'product.name as productName',
                'COUNT(l.quantity) as productTotal'
            ])
            ->leftJoin('o.lineItems', 'l')
            ->join('o.partner', 'p')
            ->join('l.product', 'product');

        if ($page && $limit) {
            $qb->setFirstResult(($page - 1) * $limit)
                ->setMaxResults($limit);
        }

        if ($sortField && $sortField != 'total') {
            if (strstr($sortField, '.') === false) {
                $sortField = 'o.' . $sortField;
            }
            $qb->orderBy($sortField, $sortDirection);
        }

        $this->addCriteria($qb, $params);

        $qb->groupBy('p.id, l.product');

        $mainQuery = $qb->getQuery()->getArrayResult();
        $mainQuery = $this->getReadyToDisplayData($mainQuery);

        if ($params->has('startingAt') && $params->has('endingAt')) {
            $dateFrom = new \DateTime($params->get('startingAt'));
            $dateTo = new \DateTime($params->get('endingAt'));

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
                    $localMonth = $this->distributionTotalsPerMonth($params);
                    $localMonth = $this->getReadyToDisplayData($localMonth, $dateFrom);

                    foreach ($mainQuery as $key => $mainResult) {
                        foreach ($localMonth as $localResult) {
                            if ($mainResult['id'] === $localResult['id']) {
                                foreach ($availableProducts as $product) {
                                    $mainQuery[$key][$product['sku'] .'-'. $dateFrom->format('Y-m')] = $localResult[$product['sku'] .'-'. $dateFrom->format('Y-m')];
                                }
                            }
                        }
                    }

                    $dateFrom = $dateFrom->modify('next month');

                }
            }
        }

        return $mainQuery;
    }

    public function findDistributionTotalsCount(ParameterBag $params)
    {

        $qb = $this->createQueryBuilder('o')
            ->select('p.id')
            ->join('o.partner', 'p')
            ->groupBy('p.id');

        $this->addCriteria($qb, $params);

        $paginator = new Paginator($qb->getQuery());
        return $paginator->count();
    }

    /**
     * @param Partner $partner
     * @return BulkDistribution[]
     */
    public function getDistributionsForForcasting(Partner $partner)
    {
        $monthsBack = $partner->getForecastAverageMonths() ?: 3;

        $qb = $this->createQueryBuilder('o')
            ->andWhere('o.partner = :partner')
            ->setParameter('partner', $partner)
            ->orderBy('o.distributionPeriod', 'DESC')
            ->setMaxResults($monthsBack);

        $results = $qb->getQuery()->execute();
        return $results;
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

        if ($params->has('distributionPeriod')) {
            $qb->andWhere('o.distributionPeriod = :distributionPeriod')
                ->setParameter('distributionPeriod', $params->get('distributionPeriod'));
        }

        if ($params->has('startingAt')) {
            $qb->andWhere('o.distributionPeriod >= :startingAt')
                ->setParameter('startingAt', new \DateTime($params->get('startingAt')));
        }

        if ($params->has('endingAt')) {
            $qb->andWhere('o.distributionPeriod <= :endingAt')
                ->setParameter('endingAt', new \DateTime($params->get('endingAt')));
        }

        if ($params->has('monthAndYear')) {
            $fromTime = new \DateTime($params->get('monthAndYear') . '-01');
            $fromTime = $fromTime->format('Y-m-d H:m:i');

            $toTime = new \DateTime($fromTime . '  first day of next month');
            $toTime = $toTime->format('Y-m-d H:m:i');

            $qb->andWhere('o.distributionPeriod >= :fromTime')
                ->andWhere('o.distributionPeriod <= :toTime')
                ->setParameter('fromTime', $fromTime)
                ->setParameter('toTime', $toTime);

            $qb->orderBy('o.distributionPeriod');
        }
    }
}
