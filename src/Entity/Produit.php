<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\ManyToOne(targetEntity: familleProduit::class, inversedBy: 'produits')]
    private $famille;

    #[ORM\ManyToOne(targetEntity: uniteeproduit::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $unitee;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Production::class)]
    private $productions;

    public function __construct()
    {
        $this->productions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getFamille(): ?familleProduit
    {
        return $this->famille;
    }

    public function setFamille(?familleProduit $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getUnitee(): ?uniteeproduit
    {
        return $this->unitee;
    }

    public function setUnitee(?uniteeproduit $unitee): self
    {
        $this->unitee = $unitee;

        return $this;
    }

    /**
     * @return Collection<int, Production>
     */
    public function getProductions(): Collection
    {
        return $this->productions;
    }

    public function addProduction(Production $production): self
    {
        if (!$this->productions->contains($production)) {
            $this->productions[] = $production;
            $production->setProduit($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): self
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getProduit() === $this) {
                $production->setProduit(null);
            }
        }

        return $this;
    }
}
