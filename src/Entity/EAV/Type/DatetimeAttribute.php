<?php


namespace App\Entity\EAV\Type;

use App\Entity\EAV\Attribute;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DateTimeAttribute
 *
 * @ORM\Entity()
 */
class DatetimeAttribute extends Attribute
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime_value", type="datetime_immutable", nullable=true)
     */
    private $value;

    /**
     * @param \DateTime $value
     *
     * @return Attribute
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValue()
    {
        return $this->value;
    }

    public function fixtureData()
    {
        return new \DateTimeImmutable();
    }
}