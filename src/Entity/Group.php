<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="groups")
 */
class Group extends CoreEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
     *
     * @var User $users
     */
    protected $users;

    /**
     * @ORM\Column(type="json_array")
     *
     * @var array
     */
    protected $roles;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function addRole(string $role)
    {
        $roles = new ArrayCollection($this->roles);
        if (!$roles->contains($role)) {
            $roles->add($role);
        }
        $this->setRoles($roles->toArray());
    }

    public function removeRole(string $role)
    {
        $roles = new ArrayCollection($this->roles);
        $roles->removeElement($role);
        $this->setRoles($roles->toArray());
    }
}