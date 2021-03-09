<?php


namespace App\Entity;

use App\Entity\ValueObjects\Name;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class PartnerContact extends StorageLocationContact
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isProgramContact;

    public function __construct(Name $name = null, $title = null, $email = null, $phoneNumber = null)
    {
        parent::__construct($name, $title, $email, $phoneNumber);
        $this->isProgramContact = false;
    }

    /**
     * @return bool
     */
    public function isProgramContact(): bool
    {
        return $this->isProgramContact;
    }

    /**
     * @param bool $isProgramContact
     */
    public function setIsProgramContact(bool $isProgramContact): void
    {
        $this->isProgramContact = $isProgramContact;
    }
}
