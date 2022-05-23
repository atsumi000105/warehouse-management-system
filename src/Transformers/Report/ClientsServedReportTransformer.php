<?php

namespace App\Transformers\Report;

use App\Entity\Client;
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

    public function transform(Partner $partner): array
    {
        return [
            'id' => $partner->getId(),
            'title' => $partner->getTitle(),
            'activeChildren' => $this->getActiveChildrenCount($partner),
            'children' => $this->getChildrenCount($partner),
            'activeFamilies' => $this->getActiveFamiliesCount($partner),
            'families' => $this->getFamiliesCount($partner),
        ];
    }

    public function getActiveFamiliesCount(Partner $partner): int
    {
        $parameterBag = new ParameterBag();
        $parameterBag->set('partner', $partner);
        $parameterBag->set('status', Client::STATUS_ACTIVE);

        return $this->om->getRepository(Client::class)
            ->findFamiliesCount($parameterBag);
    }

    public function getFamiliesCount(Partner $partner): int
    {
        $parameterBag = new ParameterBag();
        $parameterBag->set('partner', $partner);

        return $this->om->getRepository(Client::class)
            ->findFamiliesCount($parameterBag);
    }

    public function getChildrenCount(Partner $partner): int
    {
        $parameterBag = new ParameterBag();
        $parameterBag->set('partner', $partner);
        $parameterBag->set('clientsServed', 'true');

        return $this->om->getRepository(Client::class)
            ->findAllCount($parameterBag);
    }

    public function getActiveChildrenCount(Partner $partner): int
    {
        $parameterBag = new ParameterBag();
        $parameterBag->set('partner', $partner);
        $parameterBag->set('status', Client::STATUS_ACTIVE);
        $parameterBag->set('clientsServed', 'true');

        return $this->om->getRepository(Client::class)
            ->findAllCount($parameterBag);
    }
}
