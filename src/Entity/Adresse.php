<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
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
    private $Pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CodePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdresseNumber;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="ListeAdresses")
     */
    private $ListePersonne;

    /**
     * @ORM\ManyToOne(targetEntity=Commissaire::class, inversedBy="Adresses")
     */
    private $Commissaire;

    public function __construct()
    {
        $this->ListePersonne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->CodePostal;
    }

    public function setCodePostal(string $CodePostal): self
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getAdresseNumber(): ?string
    {
        return $this->AdresseNumber;
    }

    public function setAdresseNumber(string $AdresseNumber): self
    {
        $this->AdresseNumber = $AdresseNumber;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getListePersonne(): Collection
    {
        return $this->ListePersonne;
    }

    public function addListePersonne(User $listePersonne): self
    {
        if (!$this->ListePersonne->contains($listePersonne)) {
            $this->ListePersonne[] = $listePersonne;
        }

        return $this;
    }

    public function removeListePersonne(User $listePersonne): self
    {
        $this->ListePersonne->removeElement($listePersonne);

        return $this;
    }

    public function getCommissaire(): ?Commissaire
    {
        return $this->Commissaire;
    }

    public function setCommissaire(?Commissaire $Commissaire): self
    {
        $this->Commissaire = $Commissaire;

        return $this;
    }
}
