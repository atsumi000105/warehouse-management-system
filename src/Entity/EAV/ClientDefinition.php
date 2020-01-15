<?php

namespace App\Entity\EAV;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ClientDefinition
 *
 * @ORM\Entity(repositoryClass="App\Repository\DefinitionRepository")
 */
class ClientDefinition extends Definition
{
    public $defaultEntityName = ClientDefinition::class;
}
