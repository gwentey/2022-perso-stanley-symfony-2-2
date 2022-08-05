<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:atelier:getAllAtelier"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:atelier:getAllAtelier"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:atelier:getAllAtelier"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:atelier:getAllAtelier"])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: Production::class, orphanRemoval: true)]
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
            $production->setAtelier($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): self
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getAtelier() === $this) {
                $production->setAtelier(null);
            }
        }

        return $this;
    }
}
