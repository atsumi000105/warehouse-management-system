<?php

namespace App\Listener;

use App\Entity\Client;
use App\Entity\EAV\ClientDefinition;
use Doctrine\ORM\Event\LifecycleEventArgs;

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
}
