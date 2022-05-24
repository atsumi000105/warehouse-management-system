<?php

namespace App\Transformers\Report;

use App\Entity\LineItem;
use App\Entity\Orders\BulkDistributionLineItem;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use League\Fractal\TransformerAbstract;
use PhpParser\Node\Scalar\MagicConst\Line;

class MultipleLineItemsPerMonthReportTransformer extends TransformerAbstract
{
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function transform(BulkDistributionLineItem $lineItem): array
    {
        return [
            'id' => $lineItem->getId(),
            'clientId' => $lineItem->getClient()->getId(),
            'childFirstName' => $lineItem->getClient()->getName()->getFirstname(),
            'childLastName' => $lineItem->getClient()->getName()->getLastname(),
            'parentFirstName' => $lineItem->getClient()->getParentFirstName(),
            'parentLastName' => $lineItem->getClient()->getParentLastName(),
            'distributedAt' => $lineItem->getCreatedAt()->format('Y-m-d'),
            'isDuplicate' => $this->findDuplicateRecords($lineItem),
        ];
    }

    public function findDuplicateRecords(LineItem $lineItem)
    {
        return 'hello world';
    }
}
