<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Partner;
use App\Entity\ValueObjects\Name;
use App\Transformers\ClientTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Transition;

/**
 * @Route(path="/api/clients")
 */
class ClientController extends BaseController
{
    protected $defaultEntityName = Client::class;

    /**
     * Get a list of Clients
     *
     * @Route(path="/", methods={"GET"})
     */
    public function index(Request $request): JsonResponse
    {
//        $this->checkViewPermissions($clients);

        $sort = $request->get('sort') ? explode('|', $request->get('sort')) : null;
        $page = (int) $request->get('page', 1);
        $limit = (int) $request->get('per_page', 10);

        $params = $this->buildFilterParams($request);

        $clients = $this->getRepository()->findAllPaged(
            $page,
            $limit,
            $sort ? $sort[0] : null,
            $sort ? $sort[1] : null,
            $params
        );

        $total = (int) $this->getRepository()->findAllCount($params);

        $meta = [
            'pagination' => [
                'total' => $total,
                'per_page' => $limit,
                'current_page' => $page,
                'last_page' => ceil($total / $limit),
                'next_page_url' => null,
                'prev_page_url' => null,
                'from' => (($page - 1) * $limit) + 1,
                'to' => min($page * $limit, $total),
            ]
        ];

        return $this->serialize($request, $clients, null, $meta);
    }

    /**
     * Get a single Client
     *
     * @Route(path="/{uuid}", methods={"GET"})
     */
    public function show(Request $request, Registry $workflowRegistry, string $uuid): JsonResponse
    {
        $client = $this->getClientById($uuid);
        $meta = [
            'enabledTransitions' => $this->getEnabledTransitions($workflowRegistry, $client),
        ];

//        $this->checkViewPermissions($client);

        return $this->serialize($request, $client, null, $meta);
    }

    /**
     * Save a new Client
     *
     * @Route(path="", methods={"POST"})
     */
    public function store(Request $request, Registry $workflowRegistry): JsonResponse
    {
        $params = $this->getParams($request);

        $client = new Client($workflowRegistry);

        if ($params['partner']['id']) {
            $newPartner = $this->getEm()->find(Partner::class, $params['partner']['id']);
            $client->setPartner($newPartner);
        }

        $client->applyChangesFromArray($params);

//        $this->checkEditPermissions($client);

        $this->getEm()->persist($client);
        $this->getEm()->flush();

        return $this->serialize($request, $client);
    }

    /**
     * Whole or partial update of a client
     *
     * @Route(path="/{uuid}", methods={"PATCH"})
     */
    public function update(Request $request, string $uuid): JsonResponse
    {
        $params = $this->getParams($request);
        /** @var Client $client */
        $client = $this->getClientById($uuid);

//        $this->checkEditPermissions($client);

        if ($params['name']) {
            $name = new Name($params['name']['firstName'], $params['name']['lastName']);
            $client->setName($name);
            unset($params['name']);
        }

        if (isset($params['partner']['id'])) {
            $newPartner = $this->getEm()->find(Partner::class, $params['partner']['id']);
            $client->setPartner($newPartner);
        }

        $client->applyChangesFromArray($params);

        $this->getEm()->persist($client);
        $this->getEm()->flush();

        return $this->serialize($request, $client);
    }

    /**
     * Delete a client
     *
     * @Route(path="/{uuid}", methods={"DELETE"})
     */
    public function destroy(Request $request, string $uuid): JsonResponse
    {
        $client = $this->getClientById($uuid);

//        $this->checkEditPermissions($client);

        $this->getEm()->remove($client);

        $this->getEm()->flush();

        return $this->success(sprintf('Client "%s" deleted.', $client->getName()));
    }

    /**
     * @Route("/{uuid}/transition", methods={"PATCH"})
     */
    public function transition(Request $request, Registry $workflowRegistry, string $uuid): JsonResponse
    {
        $client = $this->getClientById($uuid);

        $params = $this->getParams($request);

        if ($params['transition']) {
            $workflowRegistry
                ->get($client)
                ->apply($client, $params['transition']);

            $this->getEm()->flush();
        }

        $meta = [
            'enabledTransitions' => $this->getEnabledTransitions($workflowRegistry, $client),
        ];

        return $this->serialize($request, $client, null, $meta);
    }

     /**
     * @param Request $request
     * @return ParameterBag
     */
    protected function buildFilterParams(Request $request)
    {
        $params = new ParameterBag();

        if ($request->get('keyword')) {
            $params->set('keyword', $request->get('keyword'));
        }

        if ($request->get('partner')) {
            $partner = $this->getEm()->getRepository(Partner::class)->find($request->get('partner'));
            $params->set('partner', $partner);
        }

        /** @var User $user */
        $user = $this->getUser();

        // If the user isn't an admin,
        if (!$user->hasRole(Client::ROLE_VIEW_ALL)) {
            $params->set('partner', $user->getActivePartner());
        }

        return $params;
    }

    protected function getDefaultTransformer(): ClientTransformer
    {
        return new ClientTransformer();
    }

    protected function getClientById(string $id): Client
    {
        /** @var Client $client */
        $client = $this->getRepository()->findOneByUuid($id);

        if (!$client) {
            throw new NotFoundHttpException(sprintf('Unknown Client ID: %s', $id));
        }

        return $client;
    }

    /**
     * @param Registry $workflowRegistry
     * @param Client $client
     * @return String[]
     */
    protected function getEnabledTransitions(Registry $workflowRegistry, Client $client): array
    {
        $workflow = $workflowRegistry->get($client);
        $enabledTransitions = $workflow->getEnabledTransitions($client);

        return array_map(function (Transition $transition) use ($workflow) {
            $title = $workflow->getMetadataStore()->getTransitionMetadata($transition)['title'];
            return [
                'transition' => $transition->getName(),
                'title' => $title
            ];
        }, $enabledTransitions);
    }
}
