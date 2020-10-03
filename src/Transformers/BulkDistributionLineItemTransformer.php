<?php

namespace App\Transformers;

use App\Entity\LineItem;
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

    public function transform(LineItem $lineItem)
    {
        $properties = parent::transform($lineItem);

        if ($lineItem->getOrder()) {
            $properties['orderSequence'] = $lineItem->getOrder()->getSequenceNo();
            $properties['orderId'] = $lineItem->getOrder()->getId();
        }

        return $properties;

    }

    public function includeClient(BulkDistributionLineItem $lineItem)
    {
        return $this->item($lineItem->getClient(), new ClientTransformer());
    }

    public function includeOrder(LineItem $lineItem)
    {
        $order = $lineItem->getOrder();

        return $this->item($order, new BulkDistributionTransformer());
    }


}
