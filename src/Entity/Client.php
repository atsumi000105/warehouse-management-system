<?php

namespace App\Entity;

use App\Entity\EAV\AttributedEntityTrait;
use App\Entity\Orders\BulkDistributionLineItem;
use App\Entity\ValueObjects\Name;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @ORM\EntityListeners({"App\Listener\ClientListener"})
 * @Gedmo\Loggable()
 */
class Client extends CoreEntity
{
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner")
     * @Gedmo\Versioned
     */
    protected $partner;

    /**
     * @var BulkDistributionLineItem[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Orders\BulkDistributionLineItem", mappedBy="client")
     */
    protected $distributionLineItems;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
        $this->distributionLineItems = new ArrayCollection();
        $this->uuid = Uuid::uuid4();
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
}
