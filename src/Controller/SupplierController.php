<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Transformers\SupplierOptionTransformer;
use App\Transformers\SupplierTransformer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class SupplierController
 * @package App\Controller
 *
 * @Route(path="/api/suppliers")
 */
class SupplierController extends BaseController
{
    protected $defaultEntityName = Supplier::class;

    /**
     * Get a list of Suppliers
     *
     * @Route(path="", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if (!$request->get('page')) {
            $suppliers = $this->getRepository()->findAll();
            return $this->serialize($request, $suppliers);
        }

        $sort = $request->get('sort') ? explode('|', $request->get('sort')) : null;
        $page = $request->get('page', 1);
        $limit = $request->get('per_page', 10);

        $params = $this->buildFilterParams($request);

        $suppliers = $this->getRepository()->findAllPaged(
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

        return $this->serialize($request, $suppliers, null, $meta);
    }

    /**
     * Get a single Supplier
     *
     * @Route(path="/{id<\d+>}", methods={"GET"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $supplier = $this->getSupplier($id);

        return $this->serialize($request, $supplier);
    }

    /**
     * Save a new supplier
     *
     * @Route(path="", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        // TODO: Get validation working (#2)
//        $this->validate($request, [
//            'title' => 'required',
//            'contacts' => 'array',
//            'addresses' => 'array',
//        ]);

        $supplier = new Supplier($request->get('title'));

        $params = $this->getParams($request);
        $supplier->applyChangesFromArray($params);

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($supplier);

        $this->getEm()->persist($supplier);
        $this->getEm()->flush();

        return $this->serialize($request, $supplier);
    }

    /**
     * Whole or partial update of a supplier
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
        /** @var Supplier $supplier */
        $supplier = $this->getSupplier($id);

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($supplier);

        $supplier->applyChangesFromArray($params);

        $this->getEm()->persist($supplier);
        $this->getEm()->flush();

        return $this->serialize($request, $supplier);
    }

    /**
     * Delete a supplier
     *
     * @Route(path="/{id<\d+>}", methods={"DELETE"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $supplier = $this->getSupplier($id);

        // TODO: get permissions working (#1)
        // $this->checkEditPermissions($supplier);

        $this->getEm()->remove($supplier);

        $this->getEm()->flush();

        return $this->success(sprintf('Supplier "%s" deleted.', $supplier->getTitle()));
    }

    /**
     * @Route(path="/list-options")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listOptions(Request $request)
    {
        $suppliers = $this->getRepository()->findAll();

        return $this->serialize($request, $suppliers, new SupplierOptionTransformer());
    }

    public function merge(Request $request)
    {
        /** @var Supplier $target */
        $target = $this->getRepository()->find($request->get('targetSupplier'));
        /** @var Supplier[] $sources */
        $sources = $this->getRepository()->findBy(['id' => $request->get('sourceSuppliers')]);
        $context = $request->get('context');

        foreach ($sources as $source) {
            if (in_array('orders', $context)) {
                $orders = $source->getSupplyOrders();
                foreach ($orders as $order) {
                    $order->setSupplier($target);
                }
            }

            if (in_array('contacts', $context)) {
                $contacts = $source->getContacts();
                foreach ($contacts as $contact) {
                    $contact->setSupplier($target);
                }
            }

            if (in_array('addresses', $context)) {
                $addresses = $source->getAddresses();
                foreach ($addresses as $address) {
                    $address->setSupplier($target);
                }
            }

            if (in_array('deactivate', $context)) {
                $source->setStatus(Supplier::STATUS_INACTIVE);
            }
        }

        $this->getEm()->flush();

        return $this->success();
    }

    /**
     * @param $id
     * @return null|Supplier
     * @throws NotFoundHttpException
     */
    protected function getSupplier($id)
    {
        /** @var Supplier $supplier */
        $supplier = $this->getRepository()->find($id);

        if(!$supplier) {
            throw new NotFoundHttpException(sprintf('Unknown Supplier ID: %d', $id));
        }

        return $supplier;
    }

    /**
     * @param Request $request
     * @return ParameterBag
     */
    protected function buildFilterParams(Request $request)
    {
        $params = new ParameterBag();

        if ($request->get('status')) $params->set('status', $request->get('status'));
        if ($request->get('supplierType')) $params->set('supplierType', $request->get('supplierType'));
        if ($request->get('keyword')) $params->set('keyword', $request->get('keyword'));


        return $params;
    }

    protected function getDefaultTransformer()
    {
        return new SupplierTransformer;
    }
}
