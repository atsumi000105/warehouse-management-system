<?php

namespace App\Transformers;

use App\Entity\StorageLocation;
use League\Fractal\TransformerAbstract;

class StorageLocationTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'address',
        'contacts',
    ];


    public function transform(StorageLocation $storageLocation)
    {
        $classpath = explode('\\', get_class($storageLocation));

        return [
            'id' => (int) $storageLocation->getId(),
            'title' => $storageLocation->getTitle(),
            'status' => $storageLocation->getStatus(),
            'createdAt' => $storageLocation->getCreatedAt()->format('c'),
            'updatedAt' => $storageLocation->getUpdatedAt()->format('c'),
            'type' => end($classpath),

        ];
    }

    public function includeAddress(StorageLocation $storageLocation)
    {
        $address = $storageLocation->getAddress();

        if (!$address) {
            return;
        }

        return $this->item($address, new AddressTransformer());
    }

    public function includeContacts(StorageLocation $storageLocation)
    {
        $contacts = $storageLocation->getContacts();

        return $this->collection($contacts, new StorageLocationContactTransformer());
    }
}
