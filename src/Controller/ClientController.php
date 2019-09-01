<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\ValueObjects\Name;
use App\Transformers\ClientTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

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
        $clients = $this->getRepository()->findAll();

//        $this->checkViewPermissions($clients);

        return $this->serialize($request, $clients);
    }

    /**
     * Get a single Client
     *
     * @Route(path="/{uuid}", methods={"GET"})
     */
    public function show(Request $request, string $uuid): JsonResponse
    {
        $client = $this->getClientById($uuid);

//        $this->checkViewPermissions($client);

        return $this->serialize($request, $client);
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

        $client = new Client();
        $client->setName($name);

//        $this->checkEditPermissions($client);

        $this->getEm()->persist($client);
        $this->getEm()->flush();

        return $this->serialize($request, $client);
    }

    /**
     * Whole or partial update of a client
     *
     * @Route(path="/{id}", methods={"PATCH"})
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $params = $this->getParams($request);
        /** @var Client $client */
        $client = $this->getClientById($id);

//        $this->checkEditPermissions($client);

        if ($params['name']) {
            $name = new Name($params['name']['firstName'], $params['name']['lastName']);
            $client->setName($name);
            unset($params['name']);
        }

        $client->applyChangesFromArray($params);

        $this->getEm()->persist($client);
        $this->getEm()->flush();

        return $this->serialize($request, $client);
    }

    /**
     * Delete a client
     *
     * @Route(path="/{id}", methods={"DELETE"})
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        $client = $this->getClientById($id);

//        $this->checkEditPermissions($client);

        $this->getEm()->remove($client);

        $this->getEm()->flush();

        return $this->success(sprintf('Client "%s" deleted.', $client->getName()));
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
}
