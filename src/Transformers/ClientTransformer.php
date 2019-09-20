<?php

namespace App\Transformers;

use App\Entity\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function transform(Client $client): array
    {
        return [
            'id' => $client->getUuid(),
            'name' => [
                'firstName' => $client->getName()->getFirstname(),
                'lastName' => $client->getName()->getLastname(),
            ],
            'updatedAt' => $client->getUpdatedAt()->format('c'),
            'createdAt' => $client->getCreatedAt()->format('c'),
        ];
    }
}
