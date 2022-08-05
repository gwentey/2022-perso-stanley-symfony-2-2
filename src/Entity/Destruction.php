<?php

namespace App\Entity;

use App\Repository\DestructionRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:destruction:getAllDestruction"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:destruction:getAllDestruction"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: DestructionRepository::class)]
class Destruction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:destruction:getAllDestruction"])]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Groups(["read:destruction:getAllDestruction"])]
    private $date_destruction;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:destruction:getAllDestruction"])]
    private $quantite;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:destruction:getAllDestruction"])]
    private $prix_unitaire;

    #[ORM\OneToMany(mappedBy: 'destruction', targetEntity: Production::class)]
    private $productions;

    public function __construct()
    {
        $this->productions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDestruction(): ?\DateTimeInterface
    {
        return $this->date_destruction;
    }

    public function setDateDestruction(\DateTimeInterface $date_destruction): self
    {
        $this->date_destruction = $date_destruction;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(float $prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

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
            $production->setDestruction($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): self
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getDestruction() === $this) {
                $production->setDestruction(null);
            }
        }

        return $this;
    }
}
