<?php

namespace App\Listener;

use App\Entity\Client;
use App\Entity\EAV\ClientDefinition;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ClientListener
{
    public function postLoad(Client $client, LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();
        $definitions = $em->getRepository(ClientDefinition::class)->findAll();

        $emptyAttributes = array_map(function (ClientDefinition $defintion) {
            return $defintion->createAttribute();
        }, $definitions);

        $client->addAttributes($emptyAttributes, false);
    }

    public function prePersist(Client $client, LifecycleEventArgs $event)
    {
        $client->calculateAgeExpiration();
    }

    public function preUpdate(Client $client, PreUpdateEventArgs $event)
    {
        $client->calculateAgeExpiration();
    }
}
