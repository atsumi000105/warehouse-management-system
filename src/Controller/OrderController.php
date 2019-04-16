<?php

namespace App\Controller;

use App\Entity\LineItem;
use App\Entity\Order;
use App\Transformers\OrderTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends BaseController
{
    protected $defaultEntityName =  Order::class;

    /**
     * @return LineItemPartnerOrdersController.php
     * @throws \Exception
     */
    protected function createLineItem()
    {
        //This should be overwritten in subclasses
        throw new \Exception('Do not use createLineItem on OrdersController superclass.');
    }

    /**
     * Get a list of Sub-classed orders
     *
     * @Route(path="", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort') ? explode('|', $request->get('sort')) : null;
        $page = $request->get('page', 1);
        $limit = $request->get('per_page', 10);

        $params = $this->buildFilterParams($request);

        $orders = $this->getRepository()->findAllPaged(
            $page,
            $limit,
            $sort ? $sort[0] : null,
            $sort ? $sort[1] : null,
            $params
        );

        $total = $this->getRepository()->findAllCount($params);

        $meta = [
            'pagination' => [
                'total' => (int) $total,
                'per_page' => (int) $limit,
                'current_page' => (int) $page,
                'last_page' => ceil($total / $limit),
                "next_page_url" => null,
                "prev_page_url" => null,
                'from' => (($page - 1) * $limit) + 1,
                'to' => ($page * $limit),
            ]
        ];

        return $this->serialize($request, $orders, null, $meta);
    }

    /**
     * Get a single Order
     *
     * @Route(path="/{id<\d+>}", methods={"GET"})
     *
     * @param $id
     * @return array
     */
    public function show(Request $request, $id)
    {
        $order = $this->getOrder($id);

        return $this->serialize($request, $order);
    }

    /**
     * @Route(path="/bulk", methods={"GET"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bulkShow(Request $request)
    {
        $ids = $request->get('ids');

        $orders = $this->getOrders($ids);

        return $this->serialize($request, $orders);
    }

    /**
     * Whole or partial update of a order
     *
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     *
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $params = $this->getParams($request);
        /** @var Order $order */
        $order = $this->getOrder($id);

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($order);

        $this->processLineItems($order, $params['lineItems']);

        $order->applyChangesFromArray($params);

        $this->getEm()->flush();

        return $this->serialize($request, $order);
    }

    /**
     * Delete a order
     *
     * @Route(path="/{id<\d+>}", methods={"DELETE"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $order = $this->getOrder($id);

        if (!$order->isDeletable()) {
            throw new \Exception('Order has been committed and cannot be deleted.');
        }

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($order);

        $this->getEm()->remove($order);

        $this->getEm()->flush();

        return $this->success(sprintf('Order %s deleted.', $order->getId()));
    }

    /**
     * @Route(path="/bulk-change", methods={"PATCH"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bulkChange(Request $request)
    {
        $ids = $request->get('ids');
        $changes = $request->get('changes');

        /** @var Order[] $orders */
        $orders = $this->getRepository()->findBy(['id' => $ids]);

        foreach ($orders as $order) {
            // TODO: get permissions working (#1)
            // $this->checkEditPermissions($order);
            $this->checkEditable($order);

            $order->applyChangesFromArray($changes);
            $order->updateTransactions();
        }

        $this->getEm()->flush();

        return $this->success(sprintf("Orders %s have been updated", implode(", ", $ids)));
    }

    /**
     * @Route(path="/bulk-delete", methods={"PATCH"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->get('ids');

        /** @var Order[] $orders */
        $orders = $this->getRepository()->findBy(['id' => $ids]);

        foreach ($orders as $order) {
            $this->getEm()->remove($order);
        }

        $this->getEm()->flush();

        return $this->success(sprintf("Orders %s have been deleted", implode(", ", $ids)));
    }

    /**
     * @param $id
     * @return null|Order
     * @throws NotFoundHttpException
     */
    protected function getOrder($id)
    {
        /** @var Order $order */
        $order = $this->getRepository()->find($id);

        if (!$order) {
            throw new NotFoundHttpException(sprintf('Unknown Order ID: %d', $id));
        }

        return $order;
    }

    /**
     * @param int[] $id
     * @return null|Order[]
     * @throws NotFoundHttpException
     */
    protected function getOrders($ids)
    {
        /** @var Order[] $orders */
        $orders = $this->getRepository()->findBy(['id' => $ids]);

        return $orders;
    }

    protected function getDefaultTransformer()
    {
        return new OrderTransformer;
    }

    protected function processLineItems(Order $order, $lineItemsArray)
    {
        foreach ($lineItemsArray as $lineItemArray) {
            if (isset($lineItemArray['id'])) {
                $line = $order->getLineItem($lineItemArray['id']);
            } else {
                $line = $this->createLineItem();
                $order->addLineItem($line);
            }

            if (!$line->getProduct() || $line->getProduct()->getId() != $lineItemArray['product']['id']) {
                $product = $this->getEm()->getReference('App\Entity\Product', $lineItemArray['product']['id']);
                $line->setProduct($product);
            }

            $line->applyChangesFromArray($lineItemArray);

            if (!$line->getQuantity()) {
                $order->removeLineItem($line);
                continue;
            }
        }
    }

    protected function checkEditable(Order $order)
    {
        if (!$order->isEditable()) {
            throw new PermissionDeniedException(sprintf('Order %d has committed transactions and cannot be edited. Please enter a correction order.', $order->getId()));
        }
    }

    /**
     * @param Request $request
     * @return ParameterBag
     */
    protected function buildFilterParams(Request $request)
    {
        $params = new ParameterBag();

        if ($request->get('status')) {
            $params->set('status', $request->get('status'));
        }
        if ($request->get('fulfillmentPeriod')) {
            $params->set('fulfillmentPeriod', $request->get('fulfillmentPeriod'));
        }

        return $params;
    }
}
