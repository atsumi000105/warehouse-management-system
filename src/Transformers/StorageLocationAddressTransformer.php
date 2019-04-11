<?php

namespace App\Transformers;


use App\Entity\StorageLocationAddress;
use League\Fractal\TransformerAbstract;

class StorageLocationAddressTransformer extends TransformerAbstract
{

    public function transform(StorageLocationAddress $address)
    {
        return [
            'id' => (int) $address->getId(),
            'street1' => $address->getStreet1(),
            'street2' => $address->getStreet2(),
            'city' => $address->getCity(),
            'state' => $address->getState(),
            'country' => $address->getCountry(),
            'postalCode' => $address->getPostalCode(),
        ];
    }

}