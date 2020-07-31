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
            'name.firstName' => $client->getName()->getFirstName(),
            'name.lastName' => $client->getName()->getLastName(),
            'birthdate' => $client->getBirthdate()->format('c'),
            'isExpirationOverridden' => $client->isExpirationOverridden(),
            'ageExpiresAt' => $client->getAgeExpiresAt()->format('c'),
            'distributionExpiresAt' => $client->getDistributionExpiresAt() ?
                $client->getDistributionExpiresAt()->format('c') : null,
            'pullupDistributionMax' => $client->getPullupDistributionMax(),
            'pullupDistributionCount' => $client->getPullupDistributionCount(),
            'updatedAt' => $client->getUpdatedAt()->format('c'),
            'createdAt' => $client->getCreatedAt()->format('c'),
            'status' => $client->getStatus(),
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
