<?php

namespace App\Entity\Orders;

use App\Repository\OrderRepository;
use Doctrine\ORM\QueryBuilder;

class AdjustmentOrderRepository extends OrderRepository
{
    protected function joinRelatedTables(QueryBuilder $qb)
    {
        $qb->leftJoin('o.storageLocation', 'storageLocation');
    }
}
