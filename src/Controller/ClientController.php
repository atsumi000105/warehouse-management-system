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

    /** @var Registry */
    protected $workflowRegistry;

    public function __construct(Registry $workflowRegistry)
    {
        $this->workflowRegistry = $workflowRegistry;
    }

    /**
     * Get a list of Clients
     *
     * @Route(path="/", methods={"GET"})
     */
    public function index(Request $request): JsonResponse
    {
//        $this->checkViewPermissions($clients);

        $sort = $request->get('sort') ? explode('|', $request->get('sort')) : null;
        $page = $request->get('page', 1);
        $limit = $request->get('per_page', 10);

        $params = $this->buildFilterParams($request);

        $clients = $this->getRepository()->findAllPaged(
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
                'next_page_url' => null,
                'prev_page_url' => null,
                'from' => (($page - 1) * $limit) + 1,
                'to' => ($page * $limit),
            ]
        ];

        return $this->serialize($request, $clients, null, $meta);
    }

    /**
     * Get a single Client
     *
     * @Route(path="/{uuid}", methods={"GET"})
     */
    public function show(Request $request, string $uuid): JsonResponse
    {
        $client = $this->getClientById($uuid);
        $meta = [
            'enabledTransitions' => $this->getEnabledTransitions($client),
        ];

//        $this->checkViewPermissions($client);

        return $this->serialize($request, $client, null, $meta);
    }

    /**
     * Save a new Client
     *
     * @Route(path="", methods={"POST"})
     */
    public function store(Request $request): JsonResponse
    {
        $params = $this->getParams($request);

        $name = new Name(
            $params['name']['firstName'],
            $params['name']['lastName']
        );

        $client = new Client($this->workflowRegistry);
        $client->setName($name);

        if ($params['partner']['id']) {
            $newPartner = $this->getEm()->find(Partner::class, $params['partner']['id']);
            $client->setPartner($newPartner);
        }

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
    public function transition(Request $request, string $uuid): JsonResponse
    {
        $client = $this->getClientById($uuid);

        $params = $this->getParams($request);

        if ($params['transition']) {
            $this->workflowRegistry
                ->get($client)
                ->apply($client, $params['transition']);

            $this->getEm()->flush();
        }

        $meta = [
            'enabledTransitions' => $this->getEnabledTransitions($client),
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
     * @param Client $client
     * @return String[]
     */
    protected function getEnabledTransitions(Client $client): array
    {
        $enabledTransitions = $this->workflowRegistry
            ->get($client)
            ->getEnabledTransitions($client);

        return array_map(function (Transition $transition) {
            return $transition->getName();
        }, $enabledTransitions);
    }
}
