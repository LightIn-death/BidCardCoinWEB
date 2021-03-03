<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $solvable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $listeMotClef;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifSolvable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifIdentity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifRessortissants;

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSolvable(): ?string
    {
        return $this->solvable;
    }

    public function setSolvable(?string $solvable): self
    {
        $this->solvable = $solvable;

        return $this;
    }

    public function getListeMotClef(): ?string
    {
        return $this->listeMotClef;
    }

    public function setListeMotClef(?string $listeMotClef): self
    {
        $this->listeMotClef = $listeMotClef;

        return $this;
    }

    public function getVerifSolvable(): ?bool
    {
        return $this->verifSolvable;
    }

    public function setVerifSolvable(bool $verifSolvable): self
    {
        $this->verifSolvable = $verifSolvable;

        return $this;
    }

    public function getVerifIdentity(): ?bool
    {
        return $this->verifIdentity;
    }

    public function setVerifIdentity(bool $verifIdentity): self
    {
        $this->verifIdentity = $verifIdentity;

        return $this;
    }

    public function getVerifRessortissants(): ?bool
    {
        return $this->verifRessortissants;
    }

    public function setVerifRessortissants(bool $verifRessortissants): self
    {
        $this->verifRessortissants = $verifRessortissants;

        return $this;
    }
}
