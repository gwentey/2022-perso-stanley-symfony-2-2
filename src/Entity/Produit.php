<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:produit:getAllProduit"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:produit:getAllProduit"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
    private $nom;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
    private $prix;

    #[ORM\ManyToOne(targetEntity: FamilleProduit::class, inversedBy: 'produits')]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
    private $famille;

    #[ORM\ManyToOne(targetEntity: UniteeProduit::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read:produit:getAllProduit", "read:production:getAllProduction"])]
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

    public function getFamille(): ?FamilleProduit
    {
        return $this->famille;
    }

    public function setFamille(?FamilleProduit $famille): self
    {
        $this->famille = $famille;

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
