<?php

namespace App\Controller;


use App\Entity\Warehouse;
use App\Transformers\StorageLocationTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WarehouseController
 * @package App\Controller
 *
 * @Route(path="/api/warehouses")
 */
class WarehouseController extends StorageLocationController
{
    protected $defaultEntityName = Warehouse::class;

    /**
     * @Route("/")
     */
    public function index(Request $request)
    {
        $partners = $this->getRepository(Warehouse::class)->findAll();

        return $this->serialize($request, $partners);
    }

    /**
     * @Route("/{id<\d+>}")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request, int $id)
    {
        $partner = $this->getRepository(Warehouse::class)->find($id);

        return $this->serialize($request, $partner);
    }

    protected function getDefaultTransformer()
    {
        return new StorageLocationTransformer();
    }
}