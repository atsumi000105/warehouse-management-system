<?php

namespace App\Controller;

use App\Entity\Orders\PartnerOrder;
use App\Entity\Orders\PartnerOrderLineItem;
use App\Entity\Partner;
use App\Entity\Warehouse;
use App\Transformers\BagTransformer;
use App\Transformers\PartnerOrderTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PartnerOrderController
 * @package App\Controller
 *
 * @Route(path="/api/orders/partner")
 */
class PartnerOrderController extends OrderController
{
    protected $defaultEntityName = PartnerOrder::class;

    /**
     * @return PartnerOrderLineItem
     */
    protected function createLineItem()
    {
        return new PartnerOrderLineItem();
    }


    /**
     * Save a new partner order
     *
     * @Route(path="", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $params = $this->getParams($request);

        $order = new PartnerOrder();

        if ($params['warehouse']['id']) {
            $newWarehouse = $this->getEm()->find(Warehouse::class, $params['warehouse']['id']);
            $order->setWarehouse($newWarehouse);
        }

        if ($params['partner']['id']) {
            $newPartner = $this->getEm()->find(Partner::class, $params['partner']['id']);
            $order->setPartner($newPartner);
        }

        $this->processLineItems($order, $params['lineItems']);
        unset($params['lineItems']);

        $order->applyChangesFromArray($params);

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($order);

        $this->getEm()->persist($order);
        $this->getEm()->flush();

        return $this->serialize($request, $order);
    }

    /**
     * Whole or partial update of a order
     *
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws \App\Exception\CommittedTransactionException
     */
    public function update(Request $request, $id)
    {
        $params = $this->getParams($request);
        /** @var \App\Entity\Orders\PartnerOrder $order */
        $order = $this->getOrder($id);

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($order);

        $this->checkEditable($order);

        if ($params['warehouse']['id']) {
            $newWarehouse = $this->getEm()->find(Warehouse::class, $params['warehouse']['id']);
            $order->setWarehouse($newWarehouse);
        }

        if ($params['partner']['id']) {
            $newPartner = $this->getEm()->find(Partner::class, $params['partner']['id']);
            $order->setPartner($newPartner);
        }

        $this->processLineItems($order, $params['lineItems']);
        unset($params['lineItems']);

        $order->applyChangesFromArray($params);

        $this->getEm()->flush();

        return $this->serialize($request, $order);
    }

    /**
     * @Route(path="/{id<\d+>}/fill-sheet")
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function fillSheet(Request $request, $id)
    {
        /** @var \App\Entity\Orders\PartnerOrder $order */
        $order = $this->getOrder($id);

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($order);

        return $this->serialize($request, $order->buildBags(), new BagTransformer());
    }


    protected function getDefaultTransformer()
    {
        return new PartnerOrderTransformer();
    }

    protected function buildFilterParams(Request $request)
    {
        $params = parent::buildFilterParams($request);

        if ($request->get('orderPeriod')) {
            $params->set('orderPeriod', new \DateTime($request->get('orderPeriod')));
        }
        if ($request->get('partner')) {
            $params->set('partner', $this->getRepository(Partner::class)->find($request->get('partner')));
        }

        return $params;
    }
}
