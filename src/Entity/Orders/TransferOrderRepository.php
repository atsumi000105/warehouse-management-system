<?php

namespace App\Entity\Orders;


use App\Entity\OrderRepository;
use Doctrine\ORM\QueryBuilder;

class TransferOrderRepository extends OrderRepository
{
    protected function joinRelatedTables(QueryBuilder $qb) {
        $qb->leftJoin('o.sourceLocation', 'sourceLocation')
            ->leftJoin('o.targetLocation', 'targetLocation');
    }
}