<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\LineItem;
use App\Entity\Orders\PartnerOrder;
use App\Entity\Orders\PartnerOrderLineItem;
use App\Entity\Partner;
use App\Entity\User;
use App\Entity\Warehouse;
use App\Exception\UserInterfaceException;
use App\Transformers\BagTransformer;
use App\Transformers\PartnerOrderLineItemTransformer;
use App\Transformers\PartnerOrderTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
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
                throw new UserInterfaceException(
                    sprintf('%s is not in an allowed status to place new orders.', $newPartner->getTitle())
                );
            }

            $order->setPartner($newPartner);
        }

        $this->processLineItems($order, $params['lineItems']);
        unset($params['lineItems']);

        $order->applyChangesFromArray($params);

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($order);

        // Check if the partner has already submitted an order for the specified month.
        $existingOrder = $this->getRepository()->findOneBy([
            'partner' => $order->getPartner(),
            'orderPeriod' => $order->getOrderPeriod(),
        ]);

        if ($existingOrder) {
            throw new UserInterfaceException(
                sprintf(
                    '%s has already placed and order for %s.',
                    $order->getPartner()->getTitle(),
                    $order->getOrderPeriod()->format('M Y')
                )
            );
        }

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
     * @param MailerInterface $mailer
     * @param $id
     * @return JsonResponse
     * @throws \App\Exception\CommittedTransactionException
     */
    public function update(Request $request, MailerInterface $mailer, $id)
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

        $this->emailOrderUpdate($order, $mailer);

        return $this->serialize($request, $order);
    }

    /**
     * @param PartnerOrderLineItem $lineItem
     * @param array $lineItemArray
     */
    protected function extraLineItemProcessing(LineItem $lineItem, array $lineItemArray): void
    {
        if (isset($lineItemArray['client']['id'])) {
            $client = $this->getEm()->getRepository(Client::class)->findOneByPublicId($lineItemArray['client']['id']);
            $lineItem->setClient($client);
        }
    }

    /**
     * Generate line items for each client for use in the edit view
     *
     * @Route(path="/new-line-items-for-partner/{id<\d+>}", methods={"GET"})
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function createLineItemsForPartner(Request $request, int $id): JsonResponse
    {
        /** @var Partner $partner */
        $partner = $this->getEm()->getRepository(Partner::class)->find($id);
        $clients = $partner->getClients()->getValues();

        $lineItems = array_map(function ($client) {
            $line = new PartnerOrderLineItem();
            $line->setClient($client);
            return $line;
        }, $clients);

        return $this->serialize($request, $lineItems, new PartnerOrderLineItemTransformer());
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

    /**
     * Whole or partial update of a order
     *
     * @Route(path="/partner-can-order", methods={"GET"})
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function partnerCanOrder(Request $request)
    {
        $params = $this->getParams($request);
        $partner = $this->getRepository(Partner::class)->find($params['partnerId']);
        $orderPeriod = new \DateTime($params['orderPeriod']);

        $existingOrder = $this->getRepository()->findOneBy([
            'partner' => $partner,
            'orderPeriod' => $orderPeriod,
        ]);

        return $this->meta($existingOrder === null);
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

    /**
     * Only for demo purposes
     *
     * @param PartnerOrder $order
     * @param MailerInterface $mailer
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    private function emailOrderUpdate(PartnerOrder $order, MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
            ->addFrom('andrew@koebbe.com')
            ->subject('Order Updated')
            ->htmlTemplate('emails/order-update.html.twig')
            ->textTemplate('emails/order-update.txt.twig')
            ->context([
                'order' => $order,
                'partner' =>  $order->getPartner(),
            ]);

        foreach ($order->getPartner()->getProgramContacts() as $programContact) {
            $email->addTo($programContact->getEmail());
        }

        $mailer->send($email);
    }
}
