<?php

namespace App\Controller;

use App\Entity\EAV\Attribute;
use App\Entity\EAV\PartnerProfileAttributeDefinition;
use App\Entity\Partner;
use App\Entity\PartnerDistributionMethod;
use App\Entity\PartnerFulfillmentPeriod;
use App\Entity\PartnerProfile;
use App\Repository\PartnerRepository;
use App\Security\PartnerVoter;
use App\Service\EavAttributeProcessor;
use App\Transformers\ClientTransformer;
use App\Transformers\PartnerProfileTransformer;
use App\Transformers\PartnerTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

/**
 * Class PartnerController
 * @package App\Controller
 *
 * @Route(path="/api/partners")
 */
class PartnerController extends BaseController
{
    protected $defaultEntityName = Partner::class;

    /**
     *
     * @Route("/", methods={"GET"})
     * @IsGranted({"ROLE_PARTNER_VIEW_ALL","ROLE_PARTNER_MANAGE_OWN"})
     *
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort') ? explode('|', $request->get('sort')) : null;
        $page = $request->get('page', 1);
        $limit = $request->get('per_page', 10);
        $params = $this->buildFilterParams($request);
        $meta = [];

        if ($this->getUser()->hasRole(Partner::ROLE_VIEW_ALL)) {
            /** @var PartnerRepository $repo */
            $repo = $this->getRepository(Partner::class);
            $total = $repo->findAllCount($params);

            $partners = $repo->findAllPaged(
                $page,
                $limit,
                $sort ? $sort[0] : null,
                $sort ? $sort[1] : null,
                $params
            );

            $meta = [
                'pagination' => [
                    'total' => (int) $total,
                    'per_page' => (int) $limit,
                    'current_page' => (int) $page,
                    'last_page' => ceil($total / $limit),
                    'next_page_url' => null,
                    'prev_page_url' => null,
                    'from' => (($page - 1) * $limit) + 1,
                    'to' => ($page * $limit),
                ]
            ];
        } else {
            $partners = [$this->getUser()->getActivePartner()];
        }

        return $this->serialize($request, $partners, null, $meta);
    }

    /**
     *
     * @Route("", methods={"POST"})
     * @IsGranted({"ROLE_PARTNER_EDIT_ALL"})
     *
     */
    public function store(Request $request, Registry $workflowRegistry, EavAttributeProcessor $eavProcessor)
    {
        $params = $this->getParams($request);

        $partner = new Partner($params['title'], $workflowRegistry);

        $this->denyAccessUnlessGranted(PartnerVoter::EDIT, $partner);

        $partnerProfile = new PartnerProfile();
        $partner->setProfile($partnerProfile);

        $eavProcessor->processAttributeChanges($partnerProfile, $params['profile']);

        $partner->applyChangesFromArray($params);

        if ($params['distributionMethod']['id']) {
            $newMethod = $this->getEm()->find(PartnerDistributionMethod::class, $params['distributionMethod']['id']);
            $partner->setDistributionMethod($newMethod);
        }

        if ($params['fulfillmentPeriod']['id']) {
            $newPeriod = $this->getEm()->find(PartnerFulfillmentPeriod::class, $params['fulfillmentPeriod']['id']);
            $partner->setFulfillmentPeriod($newPeriod);
        }

        $this->getEm()->persist($partner);

        $this->getEm()->flush();

        return $this->serialize($request, $partner);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route(path="/new-profile", methods={"GET"})
     */
    public function newProfile(Request $request): JsonResponse
    {
        $profile = new PartnerProfile();
        $fields = $this->getRepository(PartnerProfileAttributeDefinition::class)->findAll();

        $attributes = array_map(function (PartnerProfileAttributeDefinition $definition) {
            return new Attribute($definition);
        }, $fields);

        $profile->addAttributes($attributes);

        return $this->serialize($request, $profile, new PartnerProfileTransformer());
    }

    /**
     *
     * @Route("/{id<\d+>}", methods={"GET"})
     * @IsGranted({"ROLE_PARTNER_VIEW_ALL","ROLE_PARTNER_MANAGE_OWN"})
     *
     */
    public function show(Request $request, Registry $workflowRegistry, int $id): JsonResponse
    {
        $partner = $this->getPartnerById($id);

        $this->denyAccessUnlessGranted(PartnerVoter::VIEW, $partner);

        $meta = [
            'enabledTransitions' => $this->getEnabledTransitions($workflowRegistry, $partner),
        ];

        return $this->serialize($request, $partner, null, $meta);
    }

    /**
     *
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     * @IsGranted({"ROLE_PARTNER_EDIT_ALL","ROLE_PARTNER_MANAGE_OWN"})
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(Request $request, EavAttributeProcessor $eavProcessor, int $id)
    {
        $params = $this->getParams($request);

        $partner = $this->getPartnerById($id);

        $this->denyAccessUnlessGranted(PartnerVoter::EDIT, $partner);

        $profile = $partner->getProfile();

        $eavProcessor->processAttributeChanges($profile, $params['profile']);

        $partner->applyChangesFromArray($params);

        if ($params['distributionMethod']['id']) {
            $newMethod = $this->getEm()->find(PartnerDistributionMethod::class, $params['distributionMethod']['id']);
            $partner->setDistributionMethod($newMethod);
        }

        if ($params['fulfillmentPeriod']['id'] !== $partner->getFulfillmentPeriod()->getId()) {
            $newPeriod = $this->getEm()->find(PartnerFulfillmentPeriod::class, $params['fulfillmentPeriod']['id']);
            $partner->setFulfillmentPeriod($newPeriod);
        }

        $this->getEm()->persist($partner);
        $this->getEm()->flush();

        return $this->serialize($request, $partner);
    }

    /**
     * Delete a Partner
     *
     * @Route(path="/{id}", methods={"DELETE"})
     * @IsGranted({"ROLE_PARTNER_EDIT_ALL"})
     *
     */
    public function destroy(int $id): JsonResponse
    {
        $partner = $this->getPartnerById($id);

        $this->denyAccessUnlessGranted(PartnerVoter::EDIT, $partner);

        $this->getEm()->remove($partner);
        $this->getEm()->flush();

        return $this->success(sprintf('Partner "%s" deleted', $partner->getTitle()));
    }

    /**
     *
     * @Route("/{id<\d+>}/clients", methods={"GET"})
     * @IsGranted({
     *     "ROLE_PARTNER_VIEW_ALL",
     *     "ROLE_PARTNER_MANAGE_OWN",
     *     "ROLE_CLIENT_VIEW_ALL",
     *     "ROLE_CLIENT_MANAGE_OWN"
     * })
     *
     */
    public function clients(Request $request, int $id): JsonResponse
    {
        $partner = $this->getPartnerById($id);

        return $this->serialize($request, $partner->getClients()->getValues(), new ClientTransformer());
    }

    /**
     *
     * @Route("/{id<\d+>}/transition", methods={"PATCH"})
     * @IsGranted({"ROLE_PARTNER_EDIT_ALL"})
     *
     */
    public function transition(Request $request, Registry $workflowRegistry, int $id): JsonResponse
    {
        $partner = $this->getPartnerById($id);

        $params = $this->getParams($request);

        if ($params['transition']) {
            $workflowRegistry
                ->get($partner)
                ->apply($partner, $params['transition']);

            $this->getEm()->flush();
        }

        $meta = [
            'enabledTransitions' => $this->getEnabledTransitions($workflowRegistry, $partner),
        ];

        return $this->serialize($request, $partner, null, $meta);
    }

    protected function getDefaultTransformer()
    {
        return new PartnerTransformer($this->getUser());
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

        if ($request->get('id')) {
            $params->set('id', $request->get('id'));
        }

        if ($request->get('fulfillmentPeriod')) {
            $params->set('fulfillmentPeriod', $request->get('fulfillmentPeriod'));
        }

        if ($request->get('distributionMethod')) {
            $params->set('distributionMethod', $request->get('distributionMethod'));
        }

        if ($request->get('partnerType')) {
            $params->set('partnerType', $request->get('partnerType'));
        }

        return $params;
    }
}
