<?php

namespace App\Entity;

use App\Entity\EAV\AttributedEntityTrait;
use App\Entity\Orders\BulkDistributionLineItem;
use App\Entity\ValueObjects\Name;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Moment\Moment;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Registry;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @ORM\EntityListeners({"App\Listener\ClientListener"})
 * @Gedmo\Loggable()
 */
class Client extends CoreEntity
{
    public const STATUS_CREATION = 'CREATION';
    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';
    public const STATUS_LIMIT_REACHED = 'LIMIT_REACHED';
    public const STATUS_DUPLICATE_INACTIVE = 'DUPLICATE_(INACTIVE)';

    public const TRANSITION_ACTIVATE = 'ACTIVATE';
    public const TRANSITION_DEACTIVATE = 'DEACTIVATE';
    public const TRANSITION_EXPIRE = 'EXPIRE';
    public const TRANSITION_DUPLICATE_INACTIVE = 'DUPLICATE';


    use Uuidable;
    use AttributedEntityTrait;

    /**
     * The name value object which holds the
     * first and last name of the Client
     *
     * @var Name
     *
     * @ORM\Embedded(class="App\Entity\ValueObjects\Name", columnPrefix=false)
     * @Gedmo\Versioned
     */
    protected $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     * @Gedmo\Versioned
     */
    protected $birthdate;

    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner", inversedBy="clients")
     * @Gedmo\Versioned
     */
    protected $partner;

    /**
     * @var BulkDistributionLineItem[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Orders\BulkDistributionLineItem", mappedBy="client")
     */
    protected $distributionLineItems;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     */
    protected $isExpirationOverridden;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     * @Gedmo\Versioned
     */
    protected $ageExpiresAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     * @Gedmo\Versioned
     */
    protected $distributionExpiresAt;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     * @Gedmo\Versioned
     */
    protected $pullupDistributionMax;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $pullupDistributionCount;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Gedmo\Versioned
     */
    protected $status;

    /** @var Registry */
    protected $workflowRegistry;

    public function __construct(Registry $workflowRegistry)
    {
        $this->attributes = new ArrayCollection();
        $this->distributionLineItems = new ArrayCollection();
        $this->uuid = Uuid::uuid4();
        $this->isExpirationOverridden = false;
        $this->pullupDistributionMax = 6;
        $this->pullupDistributionCount = 0;
        $this->workflowRegistry = $workflowRegistry;
    }

    public function __toString()
    {
        return sprintf('%s (%s)', $this->name, $this->getId());
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        if (!$name->isValid()) {
            throw new MissingMandatoryParametersException('Missing first and/or last name');
        }

        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate(): \DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     */
    public function setBirthdate(\DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return bool
     */
    public function isExpirationOverridden(): bool
    {
        return $this->isExpirationOverridden;
    }

    /**
     * @param bool $isExpirationOverridden
     */
    public function setIsExpirationOverridden(bool $isExpirationOverridden): void
    {
        $this->isExpirationOverridden = $isExpirationOverridden;
    }

    /**
     * @return \DateTime
     */
    public function getAgeExpiresAt(): \DateTime
    {
        return $this->ageExpiresAt;
    }

    /**
     * @param \DateTime $ageExpiresAt
     */
    public function setAgeExpiresAt(\DateTime $ageExpiresAt): void
    {
        $this->ageExpiresAt = $ageExpiresAt;
    }

    /**
     * @return \DateTime
     */
    public function getDistributionExpiresAt(): ?\DateTime
    {
        return $this->distributionExpiresAt;
    }

    /**
     * @param \DateTime $distributionExpiresAt
     */
    public function setDistributionExpiresAt(?\DateTime $distributionExpiresAt): void
    {
        $this->distributionExpiresAt = $distributionExpiresAt;
    }

    public function getPullupDistributionMax(): ?int
    {
        return $this->pullupDistributionMax;
    }

    /**
     * @param int $pullupDistributionMax
     */
    public function setPullupDistributionMax(?int $pullupDistributionMax): void
    {
        $this->pullupDistributionMax = $pullupDistributionMax;
    }

    /**
     * @return int
     */
    public function getPullupDistributionCount(): int
    {
        return $this->pullupDistributionCount ?: 0;
    }

    /**
     * @param int $pullupDistributionCount
     */
    public function setPullupDistributionCount(int $pullupDistributionCount): void
    {
        $this->pullupDistributionCount = $pullupDistributionCount;
    }

    public function isPullupLimitReached(): bool
    {
        return $this->pullupDistributionCount >= $this->pullupDistributionMax;
    }

    public function applyChangesFromArray(array $changes): void
    {
        $this->processAttributeChanges($changes);

        parent::applyChangesFromArray($changes);
    }

    public function getPartner(): Partner
    {
        return $this->partner;
    }

    public function setPartner(Partner $partner): void
    {
        $this->partner = $partner;
    }

    /**
     * @return BulkDistributionLineItem[]|ArrayCollection
     */
    public function getDistributionLineItems()
    {
        return $this->distributionLineItems;
    }

    public function calculateAgeExpiration()
    {
        if ($this->isExpirationOverridden) {
            return;
        }

        $expiration = Moment::fromDateTime($this->getBirthdate());
        $this->ageExpiresAt = $expiration->addYears(4)->addMonths(1)->startOf('month');
    }

    public function calculateDistributionExpiration()
    {
        if ($this->isExpirationOverridden) {
            return;
        }

        $lines = $this->distributionLineItems->getValues();
        $first = array_reduce($lines, function (?\DateTime $carry, BulkDistributionLineItem $line) {
            if (is_null($carry) || $line->getOrder()->getDistributionPeriod() < $carry) {
                return $line->getOrder()->getDistributionPeriod();
            }
        }, null);

        if (!$first) {
            return null;
        }

        $firstMoment = Moment::fromDateTime($first);

        $this->distributionExpiresAt = $firstMoment->addYears(3)->addMonths(1)->startOf('month');
    }

    public function applyTransition(string $transition): void
    {
        $stateMachine = $this->workflowRegistry->get($this);
        try {
            $stateMachine->apply($this, $transition);
        } catch (LogicException $ex) {
            // TODO log this instead
            throw new \Exception(
                sprintf(
                    '%s is not a valid transition at this time. Exception thrown: %s',
                    $transition,
                    $ex->getMessage()
                )
            );
        }
    }

    /**
     * Status is set by the workflow
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
