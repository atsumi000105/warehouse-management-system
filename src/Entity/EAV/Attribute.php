<?php

namespace App\Entity\EAV;

use App\Entity\CoreEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType(value="SINGLE_TABLE")
 */
abstract class Attribute
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Definition
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\EAV\Definition", inversedBy="attributes")
     * @ORM\JoinColumn(name="definition_id", referencedColumnName="id", nullable=false)
     */
    private $definition;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getDefinition()->getLabel();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    abstract public function setValue($value);

    abstract public function getValue();

    /**
     * @param Definition $definition
     *
     * @return Attribute
     */
    public function setDefinition(Definition $definition = null)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * @return Definition
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    abstract public function fixtureData();
}
