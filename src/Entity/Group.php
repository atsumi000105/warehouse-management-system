<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\Group as BaseGroup;

/**
 * @ORM\Entity()
 * Doing the following because purging broke the DB since table names aren't back-ticked
 * @ORM\Table("`group`")
 */
class Group extends BaseGroup
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

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
    protected $permissions;

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     */
    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;
    }

    public function addPermission(string $permission)
    {
        $perms = new ArrayCollection($this->permissions);
        if (!$perms->contains($permission)) {
            $perms->add($permission);
        }
        $this->setPermissions($perms->toArray());
    }

    public function removePermission(string $permission)
    {
        $perms = new ArrayCollection($this->permissions);
        $perms->removeElement($permission);
        $this->setPermissions($perms->toArray());
    }
}
