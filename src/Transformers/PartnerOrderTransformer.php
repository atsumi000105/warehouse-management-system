<?php

namespace App\Transformers;


use App\Entity\Order;
use App\Entity\Orders\PartnerOrder;

class PartnerOrderTransformer extends OrderTransformer
{

    protected $availableIncludes = [
        'lineItems',
        'bags'
    ];

    protected $defaultIncludes = [
        'partner',
        'warehouse',
    ];

    /**
     * @param PartnerOrder $order
     * @return array
     */
    public function transform(Order $order)
    {
        $fields = parent::transform($order);

        $fields['orderPeriod'] = $order->getOrderPeriod()->format('c');
        $fields['portalOrderId'] = $order->getPortalOrderId();
        return $fields;
    }

    public function includePartner(PartnerOrder $order)
    {
        $partner = $order->getPartner();

        return $this->item($partner, new PartnerTransformer);
    }

    public function includeWarehouse(PartnerOrder $order)
    {
        $warehouse = $order->getWarehouse();

        return $this->item($warehouse, new StorageLocationTransformer);
    }

    public function includeBags(PartnerOrder $order)
    {
        return $this->collection($order->buildBags(), new BagTransformer());
    }
}