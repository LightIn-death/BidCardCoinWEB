<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="Produits")
     */
    private $Lot;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Vendeur;

    /**
     * @ORM\OneToOne(targetEntity=Enchere::class, inversedBy="Produit", cascade={"persist", "remove"})
     */
    private $EnchereGagnante;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="Produits")
     */
    private $Categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomAuteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomStyle;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PrixReserve;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ReferenceCatalogue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsSend;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoUrl;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getVendeur(): ?User
    {
        return $this->Vendeur;
    }

    public function setVendeur(?User $Vendeur): self
    {
        $this->Vendeur = $Vendeur;

        return $this;
    }

    public function getEnchereGagnante(): ?Enchere
    {
        return $this->EnchereGagnante;
    }

    public function setEnchereGagnante(?Enchere $EnchereGagnante): self
    {
        $this->EnchereGagnante = $EnchereGagnante;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getNomAuteur(): ?string
    {
        return $this->NomAuteur;
    }

    public function setNomAuteur(?string $NomAuteur): self
    {
        $this->NomAuteur = $NomAuteur;

        return $this;
    }

    public function getNomStyle(): ?string
    {
        return $this->NomStyle;
    }

    public function setNomStyle(?string $NomStyle): self
    {
        $this->NomStyle = $NomStyle;

        return $this;
    }

    public function getPrixReserve(): ?float
    {
        return $this->PrixReserve;
    }

    public function setPrixReserve(?float $PrixReserve): self
    {
        $this->PrixReserve = $PrixReserve;

        return $this;
    }

    public function getReferenceCatalogue(): ?string
    {
        return $this->ReferenceCatalogue;
    }

    public function setReferenceCatalogue(?string $ReferenceCatalogue): self
    {
        $this->ReferenceCatalogue = $ReferenceCatalogue;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getIsSend(): ?bool
    {
        return $this->IsSend;
    }

    public function setIsSend(bool $IsSend): self
    {
        $this->IsSend = $IsSend;

        return $this;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }

    public function setPhotoUrl(?string $photoUrl): self
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }
}
