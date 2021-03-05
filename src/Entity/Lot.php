<?php

namespace App\Entity;

use App\Repository\LotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LotRepository::class)
 */
class Lot
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity=OrdreAchat::class, mappedBy="Lot", orphanRemoval=true)
     */
    private $ordreAchats;

    /**
     * @ORM\OneToMany(targetEntity=Paiement::class, mappedBy="Lot", orphanRemoval=true)
     */
    private $paiements;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="Lot")
     */
    private $Produits;

    /**
     * @ORM\ManyToOne(targetEntity=Vente::class, inversedBy="Lot")
     */
    private $Vente;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="Lot")
     */
    private $Encheres;

    public function __construct()
    {
        $this->ordreAchats = new ArrayCollection();
        $this->paiements = new ArrayCollection();
        $this->Produits = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

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
            $ordreAchat->setLot($this);
        }

        return $this;
    }

    public function removeOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if ($this->ordreAchats->removeElement($ordreAchat)) {
            // set the owning side to null (unless already changed)
            if ($ordreAchat->getLot() === $this) {
                $ordreAchat->setLot(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements[] = $paiement;
            $paiement->setLot($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getLot() === $this) {
                $paiement->setLot(null);
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
            $produit->setLot($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->Produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getLot() === $this) {
                $produit->setLot(null);
            }
        }

        return $this;
    }

    public function getVente(): ?Vente
    {
        return $this->Vente;
    }

    public function setVente(?Vente $Vente): self
    {
        $this->Vente = $Vente;

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
            $enchere->setLot($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->Encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getLot() === $this) {
                $enchere->setLot(null);
            }
        }

        return $this;
    }
}
