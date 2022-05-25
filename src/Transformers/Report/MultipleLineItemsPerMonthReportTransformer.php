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

    public function transform(array $lineItem): array
    {
        return [
            'distributedAt' => $lineItem['distributedAt']->format('Y-m-d'),
            'parentFirstName' => $lineItem['parentFirstName'],
            'parentLastName' => $lineItem['parentLastName'],
            'duplicatedDistributionCount' => $lineItem['duplicatedDistributionCount'],
            'firstname' => $lineItem['firstname'],
            'lastname' => $lineItem['lastname'],
        ];
    }

    public function findDuplicateRecords(LineItem $lineItem)
    {
        return 'hello world';
    }
}
