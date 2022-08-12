<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompositionRepository::class)]
#[ApiResource]
class Composition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'Composition', targetEntity: CompositionProduit::class)]
    private Collection $compositionProduits;

    public function __construct()
    {
        $this->compositionProduits = new ArrayCollection();
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

    /**
     * @return Collection<int, CompositionProduit>
     */
    public function getCompositionProduits(): Collection
    {
        return $this->compositionProduits;
    }

    public function addCompositionProduit(CompositionProduit $compositionProduit): self
    {
        if (!$this->compositionProduits->contains($compositionProduit)) {
            $this->compositionProduits->add($compositionProduit);
            $compositionProduit->setComposition($this);
        }

        return $this;
    }

    public function removeCompositionProduit(CompositionProduit $compositionProduit): self
    {
        if ($this->compositionProduits->removeElement($compositionProduit)) {
            // set the owning side to null (unless already changed)
            if ($compositionProduit->getComposition() === $this) {
                $compositionProduit->setComposition(null);
            }
        }

        return $this;
    }
}
