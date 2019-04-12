<?php

namespace App\Entity;

use App\Entity\ValueObjects\Name;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * The name value object which holds the
     * first and last name of the user
     * @ORM\Embedded(class="App\Entity\ValueObjects\Name", columnPrefix=false)
     *
     * @var Name
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     *
     * @var Group[]|Collection
     */
    protected $groups;

    public function __construct(Name $name, string $email, string $password, ?array $roles = [])
    {
        parent::__construct();

        $this->setEmail($email);
        $this->setName($name);
        $this->setPassword($password);
        $this->setRoles($roles);
    }

    public function getName() : Name
    {
        return $this->name;
    }

    /**
     * @throws MissingMandatoryParametersException
     */
    public function setName(Name $name) : void
    {
        if (!$name->isValid()) {
            throw new MissingMandatoryParametersException("Missing first and/or last name");
        }

        $this->name = $name;
    }

    public function hasPermissionTo($permission) : bool
    {
        foreach ($this->getRoles() as $role) {
            if ($role->hasPermissionTo($permission)) {
                return true;
            }
        }
        return false;
    }
}
