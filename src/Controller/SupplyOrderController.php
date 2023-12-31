<?php

namespace App\Controller;

use App\Entity\Orders\SupplyOrder;
use App\Entity\Orders\SupplyOrderLineItem;
use App\Entity\Supplier;
use App\Entity\SupplierAddress;
use App\Entity\Warehouse;
use App\Security\SupplyOrderVoter;
use App\Transformers\SupplyOrderTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

/**
 * @Route(path="/api/orders/supply")
 */
class SupplyOrderController extends BaseOrderController
{
    protected $defaultEntityName = SupplyOrder::class;

    /**
     * Save a new Supply Order
     *
     * @Route(path="", methods={"POST"})
     * @IsGranted({"ROLE_SUPPLY_ORDER_EDIT"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $params = $this->getParams($request);

        $order = new SupplyOrder();

        if ($params['warehouse']['id']) {
            $newWarehouse = $this->getEm()->find(Warehouse::class, $params['warehouse']['id']);
            $order->setWarehouse($newWarehouse);
        }

        if ($params['supplier']['id']) {
            $newSupplier = $this->getEm()->find(Supplier::class, $params['supplier']['id']);
            $order->setSupplier($newSupplier);
        }

        if ($params['supplierAddress']['id']) {
            $newSupplierAddress = $this->getEm()->find(SupplierAddress::class, $params['supplierAddress']['id']);
            $order->setSupplierAddress($newSupplierAddress);
        }

        $this->processLineItems($order, $params['lineItems']);
        unset($params['lineItems']);

        $order->applyChangesFromArray($params);

        $this->denyAccessUnlessGranted(SupplyOrderVoter::EDIT, $order);

        $this->getEm()->persist($order);
        $this->getEm()->flush();

        return $this->serialize($request, $order);
    }

    /**
     * Whole or partial update of a order
     *
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     * @IsGranted({"ROLE_SUPPLY_ORDER_EDIT"})
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws \App\Exception\CommittedTransactionException
     */
    public function update(Request $request, int $id)
    {
        $params = $this->getParams($request);
        /** @var SupplyOrder $order */
        $order = $this->getOrder($id);

        $this->denyAccessUnlessGranted(SupplyOrderVoter::EDIT, $order);

        $this->checkEditable($order);

        if ($params['warehouse']['id']) {
            $newWarehouse = $this->getEm()->find('App\Entity\Warehouse', $params['warehouse']['id']);
            $order->setWarehouse($newWarehouse);
        }

        if ($params['supplier']['id']) {
            $newSupplier = $this->getEm()->find('App\Entity\Supplier', $params['supplier']['id']);
            $order->setSupplier($newSupplier);
        }

        if ($params['supplierAddress']['id']) {
            $newSupplierAddress = $this->getEm()->find('App\Entity\SupplierAddress', $params['supplierAddress']['id']);
            $order->setSupplierAddress($newSupplierAddress);
        }

        $this->processLineItems($order, $params['lineItems']);
        unset($params['lineItems']);

        $order->applyChangesFromArray($params);

        $this->getEm()->flush();

        return $this->serialize($request, $order);
    }

    /**
     * @Route("/{id}/transition", methods={"PATCH"})
     * @IsGranted({"ROLE_SUPPLY_ORDER_EDIT"})
     */
    public function transition(Request $request, Registry $workflowRegistry, int $id): JsonResponse
    {
        return parent::transition($request, $workflowRegistry, $id);
    }

    protected function getDefaultTransformer(): SupplyOrderTransformer
    {
        return new SupplyOrderTransformer();
    }

    protected function createLineItem()
    {
        return new SupplyOrderLineItem();
    }

    protected function getEditVoter(): string
    {
        return SupplyOrderVoter::EDIT;
    }

    protected function getViewVoter(): string
    {
        return SupplyOrderVoter::VIEW;
    }

    protected function buildFilterParams(Request $request)
    {
        $params = parent::buildFilterParams($request);

        if ($request->get('startingAt')) {
            $params->set('startingAt', new \DateTime($request->get('startingAt')));
        }

        if ($request->get('endingAt')) {
            $params->set('endingAt', new \DateTime($request->get('endingAt')));
        }

        if ($request->get('status')) {
            $params->set('status', $request->get('status'));
        }

        if ($request->get('supplier')) {
            $params->set('supplier', $request->get('supplier'));
        }

        if ($request->get('warehouse')) {
            $params->set('warehouse', $request->get('warehouse'));
        }
        return $params;
    }
}
