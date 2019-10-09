<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\PartnerProfile;
use App\Transformers\PartnerTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @Route("/", methods={"GET"})
     */
    public function index(Request $request)
    {
        $partners = $this->getRepository(Partner::class)->findAll();

        return $this->serialize($request, $partners);
    }

    /**
     * @Route("", methods={"POST"})
     */
    public function store(Request $request)
    {
        $params = $this->getParams($request);

        $partner = new Partner($params['title']);
        $partnerProfile = new PartnerProfile();
        $partner->setProfile($partnerProfile);

        $partner->applyChangesFromArray($params);

        $this->getEm()->persist($partner);

        $this->getEm()->flush();

        return $this->serialize($request, $partner);
    }
    
    /**
     * @Route("/{id<\d+>}", methods={"GET"})
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $partner = $this->getPartnerById($id);

        return $this->serialize($request, $partner);
    }

    protected function getDefaultTransformer()
    {
        return new PartnerTransformer;
    }

    protected function getPartnerById($id): Partner
    {
        /** @var Partner $partner */
        $partner = $this->getRepository()->find($id);

        if (!$partner) {
            throw new NotFoundHttpException(sprintf('Unknown Partner ID: %d', $id));
        }

        return $partner;
    }
}
