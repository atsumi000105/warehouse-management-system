<?php

namespace App\Entity\Orders;

use App\Entity\Order;
use App\Entity\Partner;
use App\Entity\StorageLocation;
use App\Entity\Warehouse;
use App\Exception\UserInterfaceException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Transfer Order
 *
 * @ORM\Entity(repositoryClass="App\Repository\Orders\TransferOrderRepository")
 */
class TransferOrder extends Order
{
    /**
     * @var StorageLocation $sourceLocation
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\StorageLocation")
     */
    protected $sourceLocation;

    /**
     * @var StorageLocation $targetLocation
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\StorageLocation")
     */
    protected $targetLocation;

    public function __construct(StorageLocation $sourceLocation = null, StorageLocation $targetLocation = null)
    {
        parent::__construct();

        if ($sourceLocation) {
            $this->setSourceLocation($sourceLocation);
        }
        if ($targetLocation) {
            $this->setTargetLocation($targetLocation);
        }
    }

    public function getOrderTypeName() : string
    {
        return "Stock Transfer";
    }

    /**
     * @return StorageLocation
     */
    public function getSourceLocation()
    {
        return $this->sourceLocation;
    }

    /**
     * @param StorageLocation $sourceLocation
     */
    public function setSourceLocation(StorageLocation $sourceLocation)
    {
        $this->sourceLocation = $sourceLocation;
    }

    /**
     * @return StorageLocation
     */
    public function getTargetLocation()
    {
        return $this->targetLocation;
    }

    /**
     * @param StorageLocation $targetLocation
     */
    public function setTargetLocation($targetLocation)
    {
        $this->targetLocation = $targetLocation;
    }

    public function validate()
    {
        if ($this->getSourceLocation() instanceof Warehouse && $this->getTargetLocation() instanceof Partner) {
            throw new UserInterfaceException(
                'Transferring from a Warehouse to a Partner must be handled in a Partner Order'
            );
        }

        if ($this->getTargetLocation()->getId() == $this->getSourceLocation()->getId()) {
            throw new UserInterfaceException('Cannot transfer from a location to itself');
        }
    }
}
