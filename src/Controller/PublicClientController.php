<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Partner;
use App\Security\ClientVoter;
use App\Service\EavAttributeProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Routing\Annotation\Route;

class PublicClientController extends BaseController
{
    /**
     * @Route("/public/client", name="public_client")
     */
    public function index(): Response
    {
        return $this->render('public_client/index.html.twig', [
            'controller_name' => 'AnonymousClientController',
        ]);
    }

    /**
     * @Route("/api/public/client", methods={"POST"})
     *
     * @throws \Exception
     */
    public function store(
        Request $request,
        Registry $workflowRegistry,
        ValidatorInterface $validator,
        EavAttributeProcessor $eavProcessor
    ): JsonResponse {

        $params = $this->getParams($request);

        $client = new Client($workflowRegistry);

        if (isset($params['partner']['id'])) {
            $newPartner = $this->getEm()->find(Partner::class, $params['partner']['id']);
            if (!$newPartner) {
                throw new \Exception('Invalid Partner ID provided');
            }

            $client->setPartner($newPartner);
        }

        $eavProcessor->processAttributeChanges($client, $params);

        $client->applyChangesFromArray($params);

        $this->validate($client, $validator);

        $this->getEm()->persist($client);
        $this->getEm()->flush();

        return $this->serialize($request, $client);
    }
}
