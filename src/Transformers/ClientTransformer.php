<?php

namespace App\Transformers;

use App\Entity\Client;
use App\Entity\PartnerProfile;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function getDefaultIncludes()
    {
        $defaultIncludes =  parent::getDefaultIncludes();
        $defaultIncludes[] = 'attributes';
        $defaultIncludes[] = 'partner';

        return $defaultIncludes;
    }

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

    public function includeAttributes(Client $client)
    {
        return $this->collection($client->getAttributes()->toArray(), new AttributeTransformer());
    }

    public function includePartner(Client $client)
    {
        return $this->item($client->getPartner(), new PartnerTransformer());
    }
}
