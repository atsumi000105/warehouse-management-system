<?php

namespace App\Controller;

use App\Entity\Orders\AdjustmentOrder;
use App\Entity\Orders\AdjustmentOrderLineItem;
use App\Entity\StorageLocation;
use App\Transformers\AdjustmentOrderTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/orders/adjustment")
 */
class AdjustmentOrderController extends OrderController
{
    protected $defaultEntityName = AdjustmentOrder::class;

    /**
     * @return AdjustmentOrderLineItem
     */
    protected function createLineItem()
    {
        return new AdjustmentOrderLineItem();
    }


    /**
     * Save a new Adjustment
     *
     * @Route(path="", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $params = $this->getParams($request);

        $order = new AdjustmentOrder();

        if ($params['storageLocation']['id']) {
            $newLocation = $this->getEm()->find(StorageLocation::class, $params['storageLocation']['id']);
            $order->setStorageLocation($newLocation);
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
     */
    public function update(Request $request, $id)
    {
        $params = $this->getParams($request);
        /** @var \App\Entity\Orders\AdjustmentOrder $order */
        $order = $this->getOrder($id);

        $this->checkEditable($order);

        if ($params['storageLocation']['id']) {
            $newLocation = $this->getEm()->find(StorageLocation::class, $params['storageLocation']['id']);
            $order->setStorageLocation($newLocation);
        }

        $this->processLineItems($order, $params['lineItems']);
        unset($params['lineItems']);

        $order->applyChangesFromArray($params);

        $this->getEm()->flush();

        return $this->serialize($request, $order);
    }

    protected function getDefaultTransformer()
    {
        return new AdjustmentOrderTransformer;
    }
}
