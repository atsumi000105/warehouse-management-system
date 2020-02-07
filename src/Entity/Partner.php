<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    public const TYPE_AGENCY = 'AGENCY';
    public const TYPE_HOSPITAL = 'HOSPITAL';

    public const TYPES = [
        self::TYPE_AGENCY,
        self::TYPE_HOSPITAL,
    ];

    const ROLE_VIEW_ALL = 'ROLE_PARTNER_VIEW_ALL';
    const ROLE_VIEW_SELF = 'ROLE_PARTNER_VIEW_SELF';
    const ROLE_EDIT = 'ROLE_PARTNER_EDIT';

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
     * @var PartnerProfile
     *
     * @ORM\OneToOne(
     *     targetEntity="PartnerProfile",
     *     inversedBy="partner",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $profile;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Client", mappedBy="partner")
     */
    protected $clients;

    public function __construct($title)
    {
        parent::__construct($title);

        $this->clients = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getPartnerType()
    {
        return $this->partnerType;
    }

    public function setPartnerType(string $partnerType)
    {
        if (!in_array($partnerType, self::TYPES)) {
            throw new \Exception('%s is not a valid Partner Type', $partnerType);
        }

        $this->partnerType = $partnerType;
    }

    public function getFulfillmentPeriod(): PartnerFulfillmentPeriod
    {
        return $this->fulfillmentPeriod;
    }

    public function setFulfillmentPeriod(PartnerFulfillmentPeriod $fulfillmentPeriod = null)
    {
        $this->fulfillmentPeriod = $fulfillmentPeriod;
    }

    public function getDistributionMethod(): PartnerDistributionMethod
    {
        return $this->distributionMethod;
    }

    public function setDistributionMethod(PartnerDistributionMethod $distributionMethod = null)
    {
        $this->distributionMethod = $distributionMethod;
    }

    public function getForecastAverageMonths(): ?int
    {
        return $this->forecastAverageMonths;
    }

    public function setForecastAverageMonths(?int $forecastAverageMonths): void
    {
        $this->forecastAverageMonths = $forecastAverageMonths;
    }

    public function getLegacyId(): ?int
    {
        return $this->legacyId;
    }

    public function setLegacyId(int $legacyId = null): void
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

    public function getProfile(): PartnerProfile
    {
        return $this->profile;
    }

    public function setProfile(PartnerProfile $profile): void
    {
        $this->profile = $profile;
    }

    public function getClients(): Collection
    {
        return $this->clients;
    }
}
