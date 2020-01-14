<?php
namespace App\Controller;

use App\Entity\PartnerDistributionMethod;
use App\Entity\ProductCategory;
use App\Transformers\ListOptionTransformer;
use App\Transformers\ProductCategoryTransformer;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PartnerDistributionMethodController
 * @package App\Controllers
 *
 * @Route(path="/api/product-categories")
 */
class ProductCategoryController extends ListOptionController
{
    protected $defaultEntityName = ProductCategory::class;


    protected function getListOptionEntityInstance()
    {
        return new ProductCategory;
    }

    protected function getDefaultTransformer()
    {
        return new ProductCategoryTransformer();
    }
}
