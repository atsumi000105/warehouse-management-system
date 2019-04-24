<?php

namespace App\Listener;

use App\Entity\Order;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class OrderListener
{
    public function preUpdate(Order $order, PreUpdateEventArgs $event)
    {
        $order->setUpdatedAt(new \DateTime());
    }

    public function preFlush(Order $order, PreFlushEventArgs $event)
    {
        if ($order->isComplete()) {
            $order->commitTransactions();
            $order->completeOrder();
        }
    }
}
