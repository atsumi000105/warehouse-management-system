<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Product
 *
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class ProductCategory extends ListOption
{
    /**
     * If true this product category will show on partner orders.
     *
     * @ORM\Column(type="boolean")
     */
    protected $isPartnerOrderable;

    /**
     * ProductCategory constructor.
     * @param $isPartnerOrderable
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->isPartnerOrderable = true;
    }


    /**
     * @return mixed
     */
    public function getisPartnerOrderable()
    {
        return $this->isPartnerOrderable;
    }

    /**
     * @param mixed $isPartnerOrderable
     */
    public function setIsPartnerOrderable($isPartnerOrderable)
    {
        $this->isPartnerOrderable = $isPartnerOrderable;
    }
}
