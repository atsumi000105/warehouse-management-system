<?php

namespace App\Entity\Orders;

use App\Entity\Order;
use App\Entity\Partner;
use App\Entity\Warehouse;
use App\Helpers\Bag;
use App\Helpers\Pack;
use Doctrine\ORM\Mapping as ORM;
use Moment\Moment;

/**
 * Class Partner Order
 *
 * @ORM\Entity(repositoryClass="App\Repository\Orders\PartnerOrderRepository")
 */
class PartnerOrder extends Order
{
    const STATUS_IN_PROCESS = "IN_PROCESS";
    const STATUS_PENDING = "PENDING";
    const STATUS_SHIPPED = "SHIPPED";

    /**
     * @var Partner $partner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $partner;

    /**
     * @var Warehouse $warehouse
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Warehouse")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $warehouse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=false, options={"model_timezone=UTC"})
     */
    protected $orderPeriod;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $portalOrderId;

    public function __construct(Partner $partner = null, Warehouse $warehouse = null)
    {
        parent::__construct();

        $this->setStatus(self::STATUS_IN_PROCESS);

        if ($partner) {
            $this->setPartner($partner);
        }
        if ($warehouse) {
            $this->setWarehouse($warehouse);
        }
    }

    public function getOrderTypeName() : string
    {
        return "Partner Order";
    }

    public function getOrderSequencePrefix(): string
    {
        return "PTNR";
    }

    /**
     * @return Partner
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @param Partner $partner
     */
    public function setPartner(Partner $partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return Warehouse
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    /**
     * @param Warehouse $warehouse
     */
    public function setWarehouse($warehouse)
    {
        $this->warehouse = $warehouse;
    }

    public function isComplete()
    {
        return $this->getStatus() === self::STATUS_SHIPPED;
    }

    /**
     * @return bool
     */
    public function isEditable()
    {
        return $this->getStatus() !== self::STATUS_SHIPPED;
    }


    public function buildBags()
    {
        $bags = [];
        $remainderBags = [];

        $bag = new Bag();
        $currentRemainderBag = null;

        foreach ($this->getLineItems() as $lineItem) {
            $product = $lineItem->getProduct();
            $quantity = $lineItem->getQuantity();
            if (empty($quantity)) {
                continue;
            }
            while ($quantity > 0) {
                $pack = new Pack($product, $this->getPartner()->getPartnerType());
                if (!$bag->addPack($pack)) {
                    if (!$bag->isEmpty()) {
                        $bags[] = $bag;
                    }
                    $bag = new Bag();
                    $bag->addPack($pack);
                }
                $quantity -= $pack->quantity;
            }

            // Done with this product.
            //If the current bag isn't full move all the packs to the current remainder bag we have going.
            if (!$bag->isFull()) {
                if (count($remainderBags) == 0 && !$currentRemainderBag) {
                    $currentRemainderBag = new Bag();
                }
                foreach ($bag->packs as $pack) {
                    if (!$currentRemainderBag->addPack($pack)) {
                        $remainderBags[] = $currentRemainderBag;
                        $currentRemainderBag = new Bag();
                        $currentRemainderBag->addPack($pack);
                    }
                }
                // Reset the bag since we moved all the packs out.
                $bag = new Bag();
            }
        }

        if (!$bag->isEmpty()) {
            $bags[] = $bag;
        }

        if ($currentRemainderBag) {
            $remainderBags[] = $currentRemainderBag;
        }
        return array_merge($bags, $remainderBags);
    }

    /**
     * @return \DateTime
     */
    public function getOrderPeriod(): \DateTime
    {
        return $this->orderPeriod;
    }

    /**
     * @param \DateTime|string $orderPeriod
     */
    public function setOrderPeriod($orderPeriod)
    {
        if (is_string($orderPeriod)) {
            $period = new Moment($orderPeriod);
        } else {
            //TODO: This can be simplified with a ::fromDateTime in the next release of Moment.php
            $period = new Moment($orderPeriod->format('U'));
            $period->setTimezone($orderPeriod->getTimezone()->getName());
        }

        $period->startOf('month');

        $this->orderPeriod = $period;
    }

    /**
     * @return int
     */
    public function getPortalOrderId(): ?int
    {
        return $this->portalOrderId;
    }

    /**
     * @param int $portalOrderId
     */
    public function setPortalOrderId(int $portalOrderId)
    {
        $this->portalOrderId = $portalOrderId;
    }
}
