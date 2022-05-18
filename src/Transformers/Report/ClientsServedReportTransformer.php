<?php

namespace App\Transformers\Report;

use App\Entity\StorageLocation;
use App\Entity\User;
use League\Fractal\TransformerAbstract;

class ClientsServedReportTransformer extends TransformerAbstract
{
    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function transform(StorageLocation $partner): array
    {
        return [
            'id' => $partner->getId(),
            'title' => $partner->getTitle(),
            'children' => 120,
            'families' => 240,
        ];
    }
}
