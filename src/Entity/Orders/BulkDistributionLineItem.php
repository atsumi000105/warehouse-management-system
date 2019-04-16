<?php

namespace App\Entity\Orders;

use App\Entity\InventoryTransaction;
use App\Entity\LineItem;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BulkDistributionLineItem
 *
 * @ORM\Entity()
 */
class BulkDistributionLineItem extends LineItem
{

    /**
     * Partner Orders generate a deduction from the warehouse and an increase to the partner
     */
    public function generateTransactions()
    {
        // Wipe out any existing transactions
        $this->clearTransactions();

        if ($this->getQuantity() <> 0) {
            /** @var BulkDistribution $order */
            $order = $this->getOrder();
            $partnerTransaction = new InventoryTransaction($order->getPartner(), $this, 0 - $this->getQuantity());

            $this->addTransaction($partnerTransaction);
        }
    }

    public function updateTransactions()
    {
        parent::updateTransactions();

        $transactions = $this->getTransactions();

        /** @var BulkDistribution $order */
        $order = $this->getOrder();

        foreach ($transactions as $transaction) {
            $transaction->setStorageLocation($order->getPartner());
            $transaction->setDelta(0 - $this->getQuantity());
        }
    }
}
