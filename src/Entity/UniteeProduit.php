<?php

namespace App\Entity;

use App\Repository\UniteeProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:uniteeProduit:getAllUniteeProduit"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:uniteeProduit:getAllUniteeProduit"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: UniteeProduitRepository::class)]
class UniteeProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:uniteeProduit:getAllUniteeProduit", "read:produit:getAllProduit", 
    "read:production:getAllProduction", "read:production:getAllProduction"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:uniteeProduit:getAllUniteeProduit", "read:produit:getAllProduit", 
    "read:production:getAllProduction", "read:production:getAllProduction"])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'unitee', targetEntity: Composition::class)]
    private Collection $compositions;

    public function __construct()
    {
        $this->compositions = new ArrayCollection();
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
     * @return Collection<int, Composition>
     */
    public function getCompositions(): Collection
    {
        return $this->compositions;
    }

    public function addComposition(Composition $composition): self
    {
        if (!$this->compositions->contains($composition)) {
            $this->compositions->add($composition);
            $composition->setUnitee($this);
        }

        return $this;
    }

    public function removeComposition(Composition $composition): self
    {
        if ($this->compositions->removeElement($composition)) {
            // set the owning side to null (unless already changed)
            if ($composition->getUnitee() === $this) {
                $composition->setUnitee(null);
            }
        }

        return $this;
    }
}
