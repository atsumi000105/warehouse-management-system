<?php
namespace App\Controller;


use App\Entity\PartnerDistributionMethod;
use App\Transformers\ListOptionTransformer;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PartnerDistributionMethodController
 * @package App\Controllers
 *
 * @Route(path="/api/partners/distribution-methods")
 */
class PartnerDistributionMethodController extends ListOptionController
{
    protected $defaultEntityName = PartnerDistributionMethod::class;


    protected function getListOptionEntityInstance()
    {
        return new PartnerDistributionMethod();
    }

    protected function getDefaultTransformer()
    {
        return new ListOptionTransformer();
    }

}