<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Partner
 * @package App\Entities
 *
 * @ORM\Entity()
 * @Gedmo\Loggable()
 */
class Partner extends StorageLocation
{
    const TYPE_AGENCY = "AGENCY";
    const TYPE_HOSPITAL = "HOSPITAL";

    const ROLE_VIEW_ALL = "ROLE_PARTNER_VIEW_ALL";
    const ROLE_VIEW_SELF = "ROLE_PARTNER_VIEW_SELF";
    const ROLE_EDIT = "ROLE_PARTNER_EDIT";

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Gedmo\Versioned
     */
    protected $partnerType;

    /**
     * @var PartnerFulfillmentPeriod
     *
     * @ORM\ManyToOne(targetEntity="PartnerFulfillmentPeriod")
     * @Gedmo\Versioned
     */
    protected $fulfillmentPeriod;

    /**
     * @var PartnerDistributionMethod
     *
     * @ORM\ManyToOne(targetEntity="PartnerDistributionMethod")
     * @Gedmo\Versioned
     */
    protected $distributionMethod;

    /**
     * Number of previous months to average for use in forecasting.
     *
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true);
     */
    protected $forecastAverageMonths;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true);
     */
    protected $legacyId;

    /**
     * @return string
     */
    public function getPartnerType()
    {
        return $this->partnerType;
    }

    /**
     * @param string $partnerType
     */
    public function setPartnerType($partnerType)
    {
        $this->partnerType = $partnerType;
    }

    /**
     * @return PartnerFulfillmentPeriod
     */
    public function getFulfillmentPeriod()
    {
        return $this->fulfillmentPeriod;
    }

    /**
     * @param PartnerFulfillmentPeriod $fulfillmentPeriod
     */
    public function setFulfillmentPeriod(PartnerFulfillmentPeriod $fulfillmentPeriod = null)
    {
        $this->fulfillmentPeriod = $fulfillmentPeriod;
    }

    /**
     * @return PartnerDistributionMethod
     */
    public function getDistributionMethod()
    {
        return $this->distributionMethod;
    }

    /**
     * @param PartnerDistributionMethod $distributionMethod
     */
    public function setDistributionMethod(PartnerDistributionMethod $distributionMethod = null)
    {
        $this->distributionMethod = $distributionMethod;
    }

    /**
     * @return int|null
     */
    public function getForecastAverageMonths(): ?int
    {
        return $this->forecastAverageMonths;
    }

    /**
     * @param int|null $forecastAverageMonths
     */
    public function setForecastAverageMonths(?int $forecastAverageMonths): void
    {
        $this->forecastAverageMonths = $forecastAverageMonths;
    }

    /**
     * @return int|null
     */
    public function getLegacyId()
    {
        return $this->legacyId;
    }

    /**
     * @param int $legacyId
     */
    public function setLegacyId(int $legacyId = null)
    {
        $this->legacyId = $legacyId;
    }

    /**
     * {@inheritDoc}
     * @throws \Exception
     */
    public function applyChangesFromArray(array $changes): void
    {
        if (isset($changes['legacyId'])) {
            $this->setLegacyId($changes['legacyId']);
            unset($changes['legacyId']);
        }

        if (isset($changes['title'])) {
            $this->setTitle($changes['title']);
            unset($changes['title']);
        }

        if (isset($changes['partnerType'])) {
            $this->setPartnerType($changes['partnerType']);
            unset($changes['partnerType']);
        }

        if (isset($changes['status'])) {
            $this->setStatus($changes['status']);
            unset($changes['status']);
        }

        $this->setUpdatedAt(new \DateTime());

        parent::applyChangesFromArray($changes);
    }
}
