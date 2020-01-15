<?php

namespace App\Controller;

use App\Entity\EAV\ClientDefinition;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BaseAttributeController
 * @package App\Controller
 *
 * @Route(path="/api/client/attribute/definition")
 */
class ClientAttributeDefinitionController extends BaseAttributeDefinitionController
{
    protected $defaultEntityName = ClientDefinition::class;

    protected function getNewDefinition()
    {
        return new ClientDefinition();
    }
}
