<?php


namespace App\Entity;

use App\Entity\EAV\AttributedEntityTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PartnerProfile
 *
 * @ORM\Entity()
 */
class PartnerProfile extends CoreEntity
{
    use AttributedEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Partner
     *
     * @ORM\OneToOne(
     *     targetEntity="Partner",
     *     inversedBy="profile"
     * )
     */
    protected $partner;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Partner
     */
    public function getPartner(): Partner
    {
        return $this->partner;
    }

    /**
     * @param Partner $partner
     */
    public function setPartner(Partner $partner): void
    {
        $this->partner = $partner;
        $this->partner->setProfile($this);
    }



}