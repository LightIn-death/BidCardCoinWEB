<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VenteRepository::class)
 */
class Vente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Lot::class, mappedBy="Vente")
     */
    private $Lot;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class, inversedBy="Ventes")
     */
    private $Adresse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateDebut;

    public function __construct()
    {
        $this->Lot = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Lot[]
     */
    public function getLot(): Collection
    {
        return $this->Lot;
    }

    public function addLot(Lot $lot): self
    {
        if (!$this->Lot->contains($lot)) {
            $this->Lot[] = $lot;
            $lot->setVente($this);
        }

        return $this;
    }

    public function removeLot(Lot $lot): self
    {
        if ($this->Lot->removeElement($lot)) {
            // set the owning side to null (unless already changed)
            if ($lot->getVente() === $this) {
                $lot->setVente(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->Adresse;
    }

    public function setAdresse(?Adresse $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->DateDebut;
    }

    public function setDateDebut(\DateTimeInterface $DateDebut): self
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }
}
