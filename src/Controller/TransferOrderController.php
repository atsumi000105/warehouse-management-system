<?php

namespace App\Controller;

use App\Entity\Orders\TransferOrder;
use App\Entity\Orders\TransferOrderLineItem;
use App\Entity\StorageLocation;
use App\Security\TransferOrderVoter;
use App\Transformers\TransferOrderTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

/**
 * @Route(path="/api/orders/transfer")
 */
class TransferOrderController extends BaseOrderController
{
    protected $defaultEntityName = TransferOrder::class;

    /**
     * Save a new Transfer
     *
     * @Route(path="", methods={"POST"})
     * @IsGranted({"ROLE_TRANSFER_ORDER_EDIT"})
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $params = $this->getParams($request);

        $order = new TransferOrder();

        if ($params['sourceLocation']['id']) {
            $newLocation = $this->getEm()->find(StorageLocation::class, $params['sourceLocation']['id']);
            $order->setSourceLocation($newLocation);
        }

        if ($params['targetLocation']['id']) {
            $newLocation = $this->getEm()->find(StorageLocation::class, $params['targetLocation']['id']);
            $order->setTargetLocation($newLocation);
        }

        $this->processLineItems($order, $params['lineItems']);
        unset($params['lineItems']);

        $order->applyChangesFromArray($params);

        $order->validate();

        $this->denyAccessUnlessGranted(TransferOrderVoter::EDIT, $order);

        $this->getEm()->persist($order);
        $this->getEm()->flush();

        return $this->serialize($request, $order);
    }

    /**
     * Whole or partial update of a order
     *
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     * @IsGranted({"ROLE_TRANSFER_ORDER_EDIT"})
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws \App\Exception\CommittedTransactionException
     * @throws \App\Exception\UserInterfaceException
     */
    public function update(Request $request, int $id)
    {
        $params = $this->getParams($request);
        /** @var TransferOrder $order */
        $order = $this->getOrder($id);

        $this->checkEditable($order);

        $this->denyAccessUnlessGranted(TransferOrderVoter::EDIT, $order);

        if ($params['sourceLocation']['id']) {
            $newLocation = $this->getEm()->find(StorageLocation::class, $params['sourceLocation']['id']);
            $order->setSourceLocation($newLocation);
        }

        if ($params['targetLocation']['id']) {
            $newLocation = $this->getEm()->find(StorageLocation::class, $params['targetLocation']['id']);
            $order->setTargetLocation($newLocation);
        }

        $this->processLineItems($order, $params['lineItems']);
        unset($params['lineItems']);

        $order->applyChangesFromArray($params);

        $order->validate();

        $this->getEm()->flush();

        return $this->serialize($request, $order);
    }

    /**
     * @Route("/{id}/transition", methods={"PATCH"})
     * @IsGranted({"ROLE_TRANSFER_ORDER_EDIT"})
     */
    public function transition(Request $request, Registry $workflowRegistry, int $id): JsonResponse
    {
        return parent::transition($request, $workflowRegistry, $id);
    }

    protected function getDefaultTransformer(): TransferOrderTransformer
    {
        return new TransferOrderTransformer();
    }

    protected function createLineItem()
    {
        return new TransferOrderLineItem();
    }

    protected function getEditVoter(): string
    {
        return TransferOrderVoter::EDIT;
    }

    protected function getViewVoter(): string
    {
        return TransferOrderVoter::VIEW;
    }
}
