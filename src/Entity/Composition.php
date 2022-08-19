<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:production:getAllProduction"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:production:getAllProduction"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: CompositionRepository::class)]
class Composition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'composition')]
    private Collection $produits;

    #[ORM\Column]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'compositions')]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
    private UniteeProduit $unitee;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
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
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->addComposition($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeComposition($this);
        }

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

    public function getUnitee(): ?UniteeProduit
    {
        return $this->unitee;
    }

    public function setUnitee(?UniteeProduit $unitee): self
    {
        $this->unitee = $unitee;

        return $this;
    }
}
