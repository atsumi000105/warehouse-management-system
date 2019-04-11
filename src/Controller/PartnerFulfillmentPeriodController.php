<?php
namespace App\Controller;


use App\Entity\PartnerFulfillmentPeriod;
use App\Transformers\ListOptionTransformer;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PartnerFulfillmentPeriodController
 * @package App\Controllers
 *
 * @Route(path="/api/partners/fulfillment-periods")
 */
class PartnerFulfillmentPeriodController extends ListOptionController
{
    protected $defaultEntityName = PartnerFulfillmentPeriod::class;


    protected function getListOptionEntityInstance()
    {
        return new PartnerFulfillmentPeriod();
    }

    protected function getDefaultTransformer()
    {
        return new ListOptionTransformer();
    }

}