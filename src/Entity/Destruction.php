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

    #[ORM\ManyToOne(inversedBy: 'destructions')]
    private ?Production $Production = null;


    public function __construct()
    {
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

    public function getProduction(): ?Production
    {
        return $this->Production;
    }

    public function setProduction(?Production $Production): self
    {
        $this->Production = $Production;

        return $this;
    }

}
