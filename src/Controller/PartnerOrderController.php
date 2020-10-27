<?php

namespace App\Controller;

use App\Entity\Orders\PartnerOrder;
use App\Entity\Orders\PartnerOrderLineItem;
use App\Entity\Partner;
use App\Entity\User;
use App\Entity\Warehouse;
use App\Exception\UserInterfaceException;
use App\Transformers\BagTransformer;
use App\Transformers\PartnerOrderTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted({"ROLE_PARTNER_EDIT","ROLE_PARTNER_MANAGE_OWN"})
     *
     * @param Request $request
     * @return JsonResponse
     * @throws UserInterfaceException
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

            if (!$newPartner->canPlaceOrders()) {
                throw new UserInterfaceException(sprintf('%s is not in an allowed status to place new orders.', $newPartner->getTitle()));
            }

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
     * @IsGranted({"ROLE_PARTNER_EDIT","ROLE_PARTNER_MANAGE_OWN"})
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
     * @IsGranted({"ROLE_PARTNER_EDIT","ROLE_PARTNER_MANAGE_OWN"})
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

        /** @var User $user */
        $user = $this->getUser();

        // If the user isn't an admin,
        if (!$user->hasRole(PartnerOrder::ROLE_VIEW_ALL)) {
            $params->set('partner', $user->getActivePartner());
        }

        return $params;
    }
}
