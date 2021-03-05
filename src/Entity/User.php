<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
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

    /**
     * @ORM\ManyToMany(targetEntity=Adresse::class, mappedBy="ListePersonne")
     */
    private $ListeAdresses;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="Utilistateur", orphanRemoval=true)
     */
    private $Encheres;

    /**
     * @ORM\OneToMany(targetEntity=OrdreAchat::class, mappedBy="Utilistateur", orphanRemoval=true)
     */
    private $ordreAchats;

    /**
     * @ORM\OneToMany(targetEntity=Paiement::class, mappedBy="Utilisateur", orphanRemoval=true)
     */
    private $Paiements;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="Vendeur", orphanRemoval=true)
     */
    private $Produits;

    public function __construct()
    {
        $this->ListeAdresses = new ArrayCollection();
        $this->Encheres = new ArrayCollection();
        $this->ordreAchats = new ArrayCollection();
        $this->Paiements = new ArrayCollection();
        $this->Produits = new ArrayCollection();
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

    /**
     * @return Collection|Adresse[]
     */
    public function getListeAdresses(): Collection
    {
        return $this->ListeAdresses;
    }

    public function addListeAdress(Adresse $listeAdress): self
    {
        if (!$this->ListeAdresses->contains($listeAdress)) {
            $this->ListeAdresses[] = $listeAdress;
            $listeAdress->addListePersonne($this);
        }

        return $this;
    }

    public function removeListeAdress(Adresse $listeAdress): self
    {
        if ($this->ListeAdresses->removeElement($listeAdress)) {
            $listeAdress->removeListePersonne($this);
        }

        return $this;
    }

    /**
     * @return Collection|Enchere[]
     */
    public function getEncheres(): Collection
    {
        return $this->Encheres;
    }

    public function addEnchere(Enchere $enchere): self
    {
        if (!$this->Encheres->contains($enchere)) {
            $this->Encheres[] = $enchere;
            $enchere->setUtilistateur($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->Encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getUtilistateur() === $this) {
                $enchere->setUtilistateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrdreAchat[]
     */
    public function getOrdreAchats(): Collection
    {
        return $this->ordreAchats;
    }

    public function addOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if (!$this->ordreAchats->contains($ordreAchat)) {
            $this->ordreAchats[] = $ordreAchat;
            $ordreAchat->setUtilistateur($this);
        }

        return $this;
    }

    public function removeOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if ($this->ordreAchats->removeElement($ordreAchat)) {
            // set the owning side to null (unless already changed)
            if ($ordreAchat->getUtilistateur() === $this) {
                $ordreAchat->setUtilistateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->Paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->Paiements->contains($paiement)) {
            $this->Paiements[] = $paiement;
            $paiement->setUtilisateur($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->Paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getUtilisateur() === $this) {
                $paiement->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->Produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produits->contains($produit)) {
            $this->Produits[] = $produit;
            $produit->setVendeur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->Produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getVendeur() === $this) {
                $produit->setVendeur(null);
            }
        }

        return $this;
    }
}
