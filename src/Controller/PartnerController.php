<?php

namespace App\Controller;


use App\Entity\Partner;
use App\Transformers\PartnerTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PartnerController
 * @package App\Controller
 *
 * @Route(path="/api/partners")
 */
class PartnerController extends StorageLocationController
{
    protected $defaultEntityName = Partner::class;

    /**
     * @Route("/")
     */
    public function index(Request $request)
    {
        $partners = $this->getRepository(Partner::class)->findAll();

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
        $partner = $this->getRepository(Partner::class)->find($id);

        return $this->serialize($request, $partner);
    }

    protected function getDefaultTransformer()
    {
        return new PartnerTransformer;
    }
}