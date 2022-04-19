<?php

namespace App\Entity\EAV;

use App\Entity\Group;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\CoreEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeDefinitionPermissionRepository")
 */
class AttributeDefinitionPermission extends CoreEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    //private $attribute_definition_id;

    /**
     * @var AttributeDefinition
     *
     * @ORM\ManyToOne(targetEntity="AttributeDefinition", inversedBy="permissions")
     * @ORM\JoinColumn(name="attribute_definition_id", referencedColumnName="id", nullable=false)
     */
    protected $definition;

    /**
     * @var Group
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="attributeFieldPermissions")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=false)
     */
    private $group;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $can_view;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $can_edit;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return AttributeDefinition
     */
    public function getDefinition(): AttributeDefinition
    {
        return $this->definition;
    }

    /**
     * @param AttributeDefinition $definition
     *
     * @return $this
     */
    public function setDefinition(AttributeDefinition $definition): self
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * @return Group
     */
    public function getGroup(): Group
    {
        return $this->group;
    }

    /**
     * @param Group $group
     *
     * @return $this
     */
    public function setGroup(Group $group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->group_id;
    }

    /**
     * @param int $group_id
     * @return $this
     */
    public function setGroupId(int $group_id): self
    {
        $this->group_id = $group_id;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCanView(): ?bool
    {
        return $this->can_view;
    }

    /**
     * @param bool $can_view
     * @return $this
     */
    public function setCanView(bool $can_view): self
    {
        $this->can_view = $can_view;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCanEdit(): ?bool
    {
        return $this->can_edit;
    }

    /**
     * @param bool $can_edit
     * @return $this
     */
    public function setCanEdit(bool $can_edit): self
    {
        $this->can_edit = $can_edit;

        return $this;
    }
}
