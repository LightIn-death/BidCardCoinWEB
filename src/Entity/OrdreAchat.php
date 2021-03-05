<?php

namespace App\Entity;

use App\Repository\OrdreAchatRepository;
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
}
