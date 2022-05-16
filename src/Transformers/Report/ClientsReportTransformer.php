<?php

namespace App\Transformers\Report;

use App\Entity\Client;
use App\Entity\EAV\Attribute;
use App\Entity\User;
use App\Transformers\AttributeTransformer;
use App\Transformers\BulkDistributionLineItemTransformer;
use App\Transformers\PartnerTransformer;
use Doctrine\ORM\PersistentCollection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ClientsReportTransformer extends TransformerAbstract
{
    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    protected $availableIncludes = [
        'partner',
        'attributes',
        'lastDistribution',
    ];

    public function transform(Client $client)
    {
        $attributes = $client->getAttributes();

        $authorizedPersons = [];

        $authorizedPersonFirstName = $this->getAttributeValueByName($attributes, 'alternative_pickup_first_name');
        $authorizedPersonLastName = $this->getAttributeValueByName($attributes, 'alternative_pickup_last_name');

        $parentFullName = $client->getParentFirstName() . ' ' . $client->getParentLastName();

        $authorizedPersons = [
            $parentFullName,
            $authorizedPersonFirstName . ' ' . $authorizedPersonLastName,
        ];

        return [
            'id' => $client->getPublicId(),
            'clientId' => $client->getId(),
            'childFullName' => $client->getFullName(),
            'authorizedPersons' => implode(', ', $authorizedPersons),
            'sizeOrdered' => '',
            'sizeGiven' => '',
            'sizeNextMonth' => '',
            'pickupSignature' => '',
            'dateReceived' => '',
            'expirations' => $client->calculateDistributionExpiration(),
            'notes' => '',
        ];
    }

    private function getAttributeValueByName(PersistentCollection $attributes, string $name): ?string
    {
        $values = $attributes->map(function (Attribute $attribute) use ($name) {
            if ($attribute->getDefinition()->getName() === $name) {
                return $attribute->getValues();
            }
        })->toArray();

        foreach ($values as $value) {
            if (isset($value[0])) {
                return $value[0];
            }
        }

        return null;
    }

    public function includeAttributes(Client $client)
    {
        return $this->collection($client->getAttributes()->toArray(), new AttributeTransformer($this->user));
    }

    public function includePartner(Client $client)
    {
        return $client->getPartner()
            ? $this->item($client->getPartner(), new PartnerTransformer())
            : $this->primitive(['id' => null]);
    }

    public function includeLastDistribution(Client $client): ?Item
    {
        if ($client->getLastCompleteDistributionLineItem()) {
            return $this->item(
                $client->getLastCompleteDistributionLineItem(),
                new BulkDistributionLineItemTransformer()
            );
        }

        return null;
    }
}
