<?php

namespace App\Entity;

use App\Entity\ValueObjects\Name;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends CoreEntity implements UserInterface
{
    public const ROLE_VIEW = 'ROLE_USER_VIEW';
    public const ROLE_EDIT = 'ROLE_USER_EDIT';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

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

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string The unhashed password
     */
    private $plainTextPassword;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @throws MissingMandatoryParametersException
     */
    public function setName(Name $name): void
    {
        if (!$name->isValid()) {
            throw new MissingMandatoryParametersException("Missing first and/or last name");
        }

        $this->name = $name;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->name;
    }

    /**
     * @return Group[]
     */
    public function getGroups(): array
    {
        return $this->groups->toArray();
    }

    /**
     * @param Group[]|Collection $groups
     */
    public function setGroups($groups): void
    {
        if (is_array($groups)) {
            $groups = new ArrayCollection($groups);
        }

        $this->groups = $groups;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = [];
        foreach ($this->groups as $group) {
            $roles += $group->getRoles();
        }

        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * This method assumes that the $password is already encoded
     *
     * Once set, the plainTextPassword will be deleted.
     *
     * {@internal use self::setPlainTextPassword instead}
     * @param string $encryptedPassword
     * @return User
     */
    public function setPasswordFromEncrypted(string $encryptedPassword): self
    {
        $this->password = $encryptedPassword;
        $this->plainTextPassword = null;

        return $this;
    }

    public function getPlainTextPassword(): ?string
    {
        return $this->plainTextPassword;
    }
    public function setPlainTextPassword(string $plainTextPassword): void
    {
        $this->plainTextPassword = $plainTextPassword;
        $this->password = null;
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        // not needed when using the "bcrypt" or "argon2i" algorithm in security.yaml
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        $this->plainTextPassword = null;
    }
}
