<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User Groups
 *
 * @ORM\Entity()
 * @ORM\Table(name="groups")
 */
class Group extends CoreEntity
{
    const AVAILABLE_ROLES = [
        Order::ROLE_VIEW_OWN,
        Order::ROLE_VIEW_ALL,
        Order::ROLE_EDIT,

        Supplier::ROLE_VIEW,
        Supplier::ROLE_EDIT,

        Warehouse::ROLE_VIEW,
        Warehouse::ROLE_EDIT,

        Partner::ROLE_VIEW_ALL,
        Partner::ROLE_VIEW_SELF,
        Partner::ROLE_EDIT,

        Product::ROLE_VIEW,
        Product::ROLE_EDIT,

        User::ROLE_VIEW,
        User::ROLE_EDIT,
    ];

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
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getRoles() : array
    {
        return $this->roles;
    }

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
