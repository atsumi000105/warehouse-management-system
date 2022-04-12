<?php

namespace App\Controller;

use App\Controller\Traits\EmailTrait;
use App\Entity\Client;
use App\Entity\Partner;
use App\Service\EavAttributeProcessor;
use App\Transformers\ClientTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Routing\Annotation\Route;

class PublicClientController extends BaseController
{
    use EmailTrait;

    protected $defaultEntityName = Client::class;

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
        EavAttributeProcessor $eavProcessor,
        TransportInterface $mailer
    ): JsonResponse {

        $params = $this->getParams($request);
        $attributes = $params['attributes'];

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

        $emailContext = [
            'parentName' => $client->getParentFirstName() . ' ' . $client->getParentLastName(),
        ];

        $clientEmailAddress = $this->findAttributeValue($attributes, 'email_address');

        if (isset($clientEmailAddress['value']) && !empty($clientEmailAddress['value'])) {
            $this->sendTemplatedEmail($mailer, 'emails/public_client/signup-confirmation.html.twig', $emailContext, $clientEmailAddress['value']);
        }

        return $this->serialize($request, $client);
    }

    private function findAttributeValue(array $attributes, string $valueToFind): ?array
    {
        foreach ($attributes as $attribute) {
            if ($attribute['name'] === $valueToFind) {
                return [
                    'name' => $valueToFind,
                    'value' => $attribute['value'],
                ];
            }
        }

        return null;
    }

    protected function getDefaultTransformer(): ClientTransformer
    {
        return new ClientTransformer();
    }
}
