<?php

namespace App\Entity\Orders;

use App\Entity\Order;
use App\Entity\Partner;
use Doctrine\ORM\Mapping as ORM;
use Moment\Moment;

/**
 * Class Partner Distribution
 *
 * @ORM\Entity(repositoryClass="App\Entity\Orders\BulkDistributionOrderRepository")
 */
class BulkDistribution extends Order
{
    const STATUS_PENDING = "PENDING";

    /**
     * @var Partner $partner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $partner;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=false)
     */
    protected $distributionPeriod;

    /**
     * Portal Order ID this bulk distribution came from
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $portalOrderId;

    public function __construct(Partner $partner = null)
    {
        parent::__construct();

        $this->setStatus(self::STATUS_COMPLETED);

        if ($partner) {
            $this->setPartner($partner);
        }
    }

    public function getOrderTypeName() : string
    {
        return "Partner Distribution";
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

    public function isComplete()
    {
        return $this->getStatus() === self::STATUS_COMPLETED;
    }

    /**
     * @return bool
     */
    public function isEditable()
    {
        return $this->getStatus() !== self::STATUS_COMPLETED;
    }

    /**
     * @return \DateTime
     */
    public function getDistributionPeriod(): \DateTime
    {
        return $this->distributionPeriod;
    }

    /**
     * @param \DateTime|string $distributionPeriod
     */
    public function setDistributionPeriod($distributionPeriod)
    {
        if (is_string($distributionPeriod)) {
            $period = new Moment($distributionPeriod);
        } else {
            //TODO: This can be simplified with a ::fromDateTime in the next release of Moment.php
            $period = new Moment($distributionPeriod->format('U'));
            $period->setTimezone($distributionPeriod->getTimezone()->getName());
        }

        $period->startOf('month');

        $this->distributionPeriod = $period;
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
