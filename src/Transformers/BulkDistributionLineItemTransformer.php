<?php

namespace App\Transformers;

use App\Entity\Orders\BulkDistributionLineItem;

class BulkDistributionLineItemTransformer extends LineItemTransformer
{

    public function getDefaultIncludes()
    {
        $includes =  parent::getDefaultIncludes();

        $includes[] = 'client';
        $includes[] = 'product';
        return $includes;
    }

    public function includeClient(BulkDistributionLineItem $lineItem)
    {
        return $this->item($lineItem->getClient(), new ClientTransformer());
    }
}
