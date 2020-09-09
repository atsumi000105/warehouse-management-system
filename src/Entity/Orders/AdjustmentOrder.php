<?php

namespace App\Entity\Orders;

use App\Entity\Order;
use App\Entity\StorageLocation;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Adjustment Order
 *
 * @ORM\Entity(repositoryClass="App\Repository\Orders\AdjustmentOrderRepository")
 */
class AdjustmentOrder extends Order
{
    const ROLE_VIEW = "ROLE_ADJUSTMENT_ORDER_VIEW";
    const ROLE_EDIT = "ROLE_ADJUSTMENT_ORDER_EDIT";

    /**
     * @var StorageLocation $storageLocation
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\StorageLocation")
     */
    protected $storageLocation;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $reason;

    public function __construct(StorageLocation $storageLocation = null)
    {
        parent::__construct();

        if ($storageLocation) {
            $this->setStorageLocation($storageLocation);
        }
    }

    public function getOrderTypeName(): string
    {
        return "Stock Change";
    }

    public function getOrderSequencePrefix(): string
    {
        return "SCHG";
    }

    /**
     * @return StorageLocation
     */
    public function getStorageLocation()
    {
        return $this->storageLocation;
    }

    /**
     * @param StorageLocation $storageLocation
     */
    public function setStorageLocation($storageLocation)
    {
        $this->storageLocation = $storageLocation;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }
}
