<?php

namespace App\Transformers;

use App\Entity\Client;
use App\Entity\PartnerProfile;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'partner',
        'attributes',
    ];

    public function transform(Client $client): array
    {
        return [
            'id' => $client->getUuid(),
            'name' => [
                'firstName' => $client->getName()->getFirstname(),
                'lastName' => $client->getName()->getLastname(),
            ],
            'birthdate' => $client->getBirthdate()->format('c'),
            'isExpirationOverridden' => $client->isExpirationOverridden(),
            'ageExpiresAt' => $client->getAgeExpiresAt()->format('c'),
            'distributionExpiresAt' => $client->getDistributionExpiresAt()->format('c'),
            'updatedAt' => $client->getUpdatedAt()->format('c'),
            'createdAt' => $client->getCreatedAt()->format('c'),
        ];
    }

    public function includeAttributes(Client $client)
    {
        return $this->collection($client->getAttributes()->toArray(), new AttributeTransformer());
    }

    public function includePartner(Client $client)
    {
        return $this->item($client->getPartner(), new PartnerTransformer());
    }
}
