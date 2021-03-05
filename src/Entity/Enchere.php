<?php

namespace App\Entity;

use App\Repository\EnchereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnchereRepository::class)
 */
class Enchere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $Prix;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Adjuger;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateHeureVente;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Encheres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilistateur;

    /**
     * @ORM\OneToOne(targetEntity=Produit::class, mappedBy="EnchereGagnante", cascade={"persist", "remove"})
     */
    private $Produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getAdjuger(): ?bool
    {
        return $this->Adjuger;
    }

    public function setAdjuger(bool $Adjuger): self
    {
        $this->Adjuger = $Adjuger;

        return $this;
    }

    public function getDateHeureVente(): ?\DateTimeInterface
    {
        return $this->DateHeureVente;
    }

    public function setDateHeureVente(\DateTimeInterface $DateHeureVente): self
    {
        $this->DateHeureVente = $DateHeureVente;

        return $this;
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

    public function getProduit(): ?Produit
    {
        return $this->Produit;
    }

    public function setProduit(?Produit $Produit): self
    {
        // unset the owning side of the relation if necessary
        if ($Produit === null && $this->Produit !== null) {
            $this->Produit->setEnchereGagnante(null);
        }

        // set the owning side of the relation if necessary
        if ($Produit !== null && $Produit->getEnchereGagnante() !== $this) {
            $Produit->setEnchereGagnante($this);
        }

        $this->Produit = $Produit;

        return $this;
    }
}
