<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ZipCounty
 *
 * Represents a U.S. Zip code to County relationship
 *
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     uniqueConstraints={@ORM\UniqueConstraint(name="zip_code_county_unique",columns={"zip_code", "county_id"})},
 *     indexes={
 *         @ORM\Index(name="zip_code_idx", columns={"zip_code"}),
 *         @ORM\Index(name="county_id_idx", columns={"county_id"})
 *     }
 * )
 */
class ZipCounty
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @var string;
     *
     * @ORM\Column(type="string")
     */
    protected $zipCode;

    /**
     * @var string;
     *
     * @ORM\Column(type="string")
     */
    protected $countyName;

    /**
     * @var string;
     *
     * @ORM\Column(type="string")
     */
    protected $stateCode;

    /**
     * @var string;
     *
     * @ORM\Column(type="string")
     */
    protected $countyId;

    public function __toString()
    {
        return sprintf("%s - %s, %s", $this->zipCode, $this->countyName, $this->stateCode);
    }

    /**
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getCountyName(): ?string
    {
        return $this->countyName;
    }

    /**
     * @param string $countyName
     */
    public function setCountyName(string $countyName): void
    {
        $this->countyName = $countyName;
    }

    /**
     * @return string
     */
    public function getStateCode(): ?string
    {
        return $this->stateCode;
    }

    /**
     * @param string $stateCode
     */
    public function setStateCode(string $stateCode): void
    {
        $this->stateCode = $stateCode;
    }

    /**
     * @return string
     */
    public function getCountyId(): ?string
    {
        return $this->countyId;
    }

    /**
     * @param string $countyId
     */
    public function setCountyId(string $countyId): void
    {
        $this->countyId = $countyId;
    }
}
