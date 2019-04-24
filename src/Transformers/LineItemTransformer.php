<?php

namespace App\Transformers;

use App\Entity\LineItem;
use App\Entity\Product;
use League\Fractal\TransformerAbstract;

class LineItemTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'transactions',
        'product',
        'order',
    ];


    public function transform(LineItem $lineItem)
    {
        return [
            'id' => (int) $lineItem->getId(),
            'quantity' => (int) $lineItem->getQuantity(),
            'cost' => (float) $lineItem->getCost(),
        ];
    }

    public function includeTransactions(LineItem $lineItem)
    {
        $transactions = $lineItem->getTransactions();

        return $this->collection($transactions, new InventoryTransactionTransformer);
    }

    public function includeProduct(LineItem $lineItem)
    {
        $product = $lineItem->getProduct();

        return $this->item($product, new ProductTransformer);
    }

    public function includeOrder(LineItem $lineItem)
    {
        $order = $lineItem->getOrder();

        return $this->item($order, new OrderTransformer);
    }
}
