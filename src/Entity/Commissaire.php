<?php

namespace App\Entity;

use App\Repository\CommissaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommissaireRepository::class)
 */
class Commissaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $Age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TelephoneM;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TelephoneF;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="Commissaire")
     */
    private $Adresses;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="Commissaire")
     */
    private $Encheres;

    public function __construct()
    {
        $this->Adresses = new ArrayCollection();
        $this->Encheres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getTelephoneM(): ?string
    {
        return $this->TelephoneM;
    }

    public function setTelephoneM(?string $TelephoneM): self
    {
        $this->TelephoneM = $TelephoneM;

        return $this;
    }

    public function getTelephoneF(): ?string
    {
        return $this->TelephoneF;
    }

    public function setTelephoneF(?string $TelephoneF): self
    {
        $this->TelephoneF = $TelephoneF;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->Adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->Adresses->contains($adress)) {
            $this->Adresses[] = $adress;
            $adress->setCommissaire($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->Adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getCommissaire() === $this) {
                $adress->setCommissaire(null);
            }
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
            $enchere->setCommissaire($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->Encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getCommissaire() === $this) {
                $enchere->setCommissaire(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return strtoupper($this->Nom) .' '. $this->Prenom;
    }
}
