<?php

namespace App\Transformers;

use App\Entity\Order;
use App\Entity\Orders\BulkDistribution;

class BulkDistributionTransformer extends OrderTransformer
{

    protected $availableIncludes = [
        'lineItems',
    ];

    protected $defaultIncludes = [
        'partner',
    ];

    /**
     * @param BulkDistribution $order
     * @return array
     */
    public function transform(Order $order)
    {
        $fields = parent::transform($order);

        $fields['distributionPeriod'] = $order->getDistributionPeriod()->format('c');
        $fields['portalOrderId'] = $order->getPortalOrderId();
        return $fields;
    }

    public function includePartner(BulkDistribution $order)
    {
        $partner = $order->getPartner();

        return $this->item($partner, new PartnerTransformer);
    }

    public function includeLineItems(Order $order)
    {
        $lineItems = $order->getLineItems();

        return $this->collection($lineItems, new BulkDistributionLineItemTransformer());
    }
}
