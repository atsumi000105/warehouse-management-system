<?php

namespace App\Listener;

use App\Entity\LineItem;
use App\Entity\Orders\BulkDistributionLineItem;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;

class DistributionLineItemListener extends LineItemListener
{
    public function postPersist(BulkDistributionLineItem $line, LifecycleEventArgs $event)
    {
        $line->getClient()->calculateDistributionExpiration();
        $event->getEntityManager()->flush($line->getClient());
    }

    public function postUpdate(BulkDistributionLineItem $line, LifecycleEventArgs $event)
    {
        $line->getClient()->calculateDistributionExpiration();
        $event->getEntityManager()->flush($line->getClient());
    }
}
