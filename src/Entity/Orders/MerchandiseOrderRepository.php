<?php

namespace App\Entity\Orders;

use App\Repository\OrderRepository;
use Doctrine\ORM\QueryBuilder;

class MerchandiseOrderRepository extends OrderRepository
{
    protected function joinRelatedTables(QueryBuilder $qb)
    {
        $qb->leftJoin('o.warehouse', 'warehouse');
    }
}
