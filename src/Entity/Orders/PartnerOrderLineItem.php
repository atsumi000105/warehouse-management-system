<?php

namespace App\Entity\Orders;

use App\Entity\InventoryTransaction;
use App\Entity\LineItem;
use App\Entity\Orders\PartnerOrder;
use App\Entity\Partner;
use App\Entity\Warehouse;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PartnerOrderLineItem
 *
 * @ORM\Entity()
 */
class PartnerOrderLineItem extends LineItem
{

    /**
     * Partner Orders generate a deduction from the warehouse and an increase to the partner
     */
    public function generateTransactions()
    {
        // Wipe out any existing transactions
        $this->clearTransactions();

        if ($this->getQuantity() <> 0) {
            /** @var PartnerOrder $order */
            $order = $this->getOrder();
            $warehouseTransaction = new InventoryTransaction($order->getWarehouse(), $this, 0 - $this->getQuantity());
            $partnerTransaction = new InventoryTransaction($order->getPartner(), $this, $this->getQuantity());

            $this->addTransaction($warehouseTransaction);
            $this->addTransaction($partnerTransaction);
        }
    }

    public function updateTransactions()
    {
        parent::updateTransactions();

        $transactions = $this->getTransactions();

        /** @var PartnerOrder $order */
        $order = $this->getOrder();

        foreach ($transactions as $transaction) {
            if ($transaction->getStorageLocation() instanceof Warehouse) {
                $transaction->setStorageLocation($order->getWarehouse());
                $transaction->setDelta(0 - $this->getQuantity());
            } elseif ($transaction->getStorageLocation() instanceof Partner) {
                $transaction->setStorageLocation($order->getPartner());
                $transaction->setDelta($this->getQuantity());
            }
            $transaction->setCost($this->getCost());
        }
    }
}
