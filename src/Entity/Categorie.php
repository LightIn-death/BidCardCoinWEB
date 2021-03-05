<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="CategorieParente")
     */
    private $ListeCategorieEnfant;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="ListeCategorieEnfant")
     */
    private $CategorieParente;

    public function __construct()
    {
        $this->CategorieParente = new ArrayCollection();
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

    public function getListeCategorieEnfant(): ?self
    {
        return $this->ListeCategorieEnfant;
    }

    public function setListeCategorieEnfant(?self $ListeCategorieEnfant): self
    {
        $this->ListeCategorieEnfant = $ListeCategorieEnfant;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategorieParente(): Collection
    {
        return $this->CategorieParente;
    }

    public function addCategorieParente(self $categorieParente): self
    {
        if (!$this->CategorieParente->contains($categorieParente)) {
            $this->CategorieParente[] = $categorieParente;
            $categorieParente->setListeCategorieEnfant($this);
        }

        return $this;
    }

    public function removeCategorieParente(self $categorieParente): self
    {
        if ($this->CategorieParente->removeElement($categorieParente)) {
            // set the owning side to null (unless already changed)
            if ($categorieParente->getListeCategorieEnfant() === $this) {
                $categorieParente->setListeCategorieEnfant(null);
            }
        }

        return $this;
    }
}
