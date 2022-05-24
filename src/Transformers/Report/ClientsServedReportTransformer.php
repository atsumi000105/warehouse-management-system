<?php

namespace App\Transformers\Report;

use App\Entity\Client;
use App\Entity\LineItem;
use App\Entity\Orders\BulkDistributionLineItem;
use App\Entity\Partner;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use League\Fractal\TransformerAbstract;
use Symfony\Component\HttpFoundation\ParameterBag;

class ClientsServedReportTransformer extends TransformerAbstract
{
    protected $user;

    private $om;

    public function __construct(ObjectManager $om, User $user = null)
    {
        $this->om = $om;
        $this->user = $user;
    }

    public function transform($arrayResults): array
    {
        return [
            'id' => $arrayResults['id'],
            'title' => $arrayResults['title'],
            'clients' => $arrayResults['clients'],
            'families' => $arrayResults['families'],
        ];
    }
}
