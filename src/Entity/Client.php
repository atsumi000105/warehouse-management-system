<?php

namespace App\Entity;

use App\Entity\ValueObjects\Name;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

/**
 * @ORM\Entity(repositoryClass="App\Entity\ClientRepository")
 */
class Client extends CoreEntity
{
    use Uuidable;

    /**
     * The name value object which holds the
     * first and last name of the Client
     * @ORM\Embedded(class="App\Entity\ValueObjects\Name", columnPrefix=false)
     *
     * @var Name
     */
    protected $name;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        if (!$name->isValid()) {
            throw new MissingMandatoryParametersException('Missing first and/or last name');
        }

        $this->name = $name;
    }
}
