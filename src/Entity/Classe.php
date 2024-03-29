<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:classe:getAllClasse"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:classe:getAllClasse"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:classe:getAllClasse", "read:production:getAllProduction"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:classe:getAllClasse", "read:production:getAllProduction"])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Production::class, orphanRemoval: true)]
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
            $production->setClasse($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): self
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getClasse() === $this) {
                $production->setClasse(null);
            }
        }

        return $this;
    }
}
