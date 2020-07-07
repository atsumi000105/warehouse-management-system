<?php

namespace App\Controller;

use App\Entity\Warehouse;
use App\Transformers\StorageLocationTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * 
     * @Route("/", methods={"GET"})
     * @IsGranted({"ROLE_WAREHOUSE_VIEW"})
     * 
     */
    public function index(Request $request): JsonResponse
    {
        $this->denyAccessUnlessGranted(Warehouse::ROLE_VIEW);

        $partners = $this->getRepository(Warehouse::class)->findAll();

        return $this->serialize($request, $partners);
    }

    /**
     *
     * @Route("/{id<\d+>}", methods={"GET"})
     * @IsGranted({"ROLE_WAREHOUSE_VIEW"})
     *
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $this->denyAccessUnlessGranted(Warehouse::ROLE_VIEW);

        $partner = $this->getWarehouseById($id);

        return $this->serialize($request, $partner);
    }

    protected function getDefaultTransformer()
    {
        return new StorageLocationTransformer();
    }

    protected function getWarehouseById($id): Warehouse
    {
        /** @var Warehouse $warehouse */
        $warehouse = $this->getRepository()->find($id);

        if (!$warehouse) {
            throw new NotFoundHttpException(sprintf('Unknown Warehouse ID: %d', $id));
        }

        return $warehouse;
    }
}
