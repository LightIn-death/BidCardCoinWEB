<?php

namespace App\Entity;

use App\Repository\OrdreAchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdreAchatRepository::class)
 */
class OrdreAchat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ordreAchats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilistateur;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="ordreAchats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Lot;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Automatique;

    /**
     * @ORM\Column(type="float")
     */
    private $MontantMax;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="OrdreAchat")
     */
    private $Encheres;

    public function __construct()
    {
        $this->Encheres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilistateur(): ?User
    {
        return $this->Utilistateur;
    }

    public function setUtilistateur(?User $Utilistateur): self
    {
        $this->Utilistateur = $Utilistateur;

        return $this;
    }

    public function getLot(): ?Lot
    {
        return $this->Lot;
    }

    public function setLot(?Lot $Lot): self
    {
        $this->Lot = $Lot;

        return $this;
    }

    public function getAutomatique(): ?bool
    {
        return $this->Automatique;
    }

    public function setAutomatique(bool $Automatique): self
    {
        $this->Automatique = $Automatique;

        return $this;
    }

    public function getMontantMax(): ?float
    {
        return $this->MontantMax;
    }

    public function setMontantMax(float $MontantMax): self
    {
        $this->MontantMax = $MontantMax;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

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
            $enchere->setOrdreAchat($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->Encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getOrdreAchat() === $this) {
                $enchere->setOrdreAchat(null);
            }
        }

        return $this;
    }
}
