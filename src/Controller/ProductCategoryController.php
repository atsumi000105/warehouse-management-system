<?php

namespace App\Controller;

use App\Entity\ProductCategory;
use App\Transformers\ProductCategoryTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PartnerDistributionMethodController
 * @package App\Controllers
 *
 * @Route(path="/api/product-categories")
 * @IsGranted({"ROLE_ADMIN"})
 *
 */
class ProductCategoryController extends ListOptionController
{
    protected $defaultEntityName = ProductCategory::class;


    protected function getListOptionEntityInstance()
    {
        return new ProductCategory();
    }

    protected function getDefaultTransformer()
    {
        return new ProductCategoryTransformer();
    }
}
