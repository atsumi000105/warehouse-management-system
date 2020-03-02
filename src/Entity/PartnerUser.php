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
    protected $spartner = '1';

    /**
     * @ORM\ManyToMany(targetEntity="Partner", inversedBy="users")
     *
     * @var Partners[]|Collection
     */
    protected $spartners;

    public function s__construct($email)
    {
        parent::__construct($email);
        $this->partners = new ArrayCollection();
    }

    public function sgetPartners(): ?array
    {
        return $this->partners->toArray();
    }

    public function ssetPartners($partners): self
    {
        if (is_array($partners)) {
            $partners = new ArrayCollection($partners);
        }

        $this->partners = $partners;

        return $this;
    }
}
