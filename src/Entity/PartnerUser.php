<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerUserRepository")
 * @ORM\Table(name="users")
 */
class PartnerUser extends User
{
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Partner", inversedBy="users")
     *
     * @var Partners[]|Collection
     */
    protected $partners;

    public function __construct($email)
    {
        parent::__construct($email);
        $this->partners = new ArrayCollection();
    }

    public function getPartners(): ?array
    {
        return $this->partners->values();
    }

    public function setPartners(array $partners): self
    {
        $this->partners = new ArrayCollection($partners);

        return $this;
    }
}
