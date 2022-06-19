<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    normalizationContext: ['groups' => ["read:vente:getAllVente"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:vente:getAllVente"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:vente:getAllVente"])]
    private $id;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:vente:getAllVente"])]
    private $quantite;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:vente:getAllVente"])]
    private $prix_unitaire;

    #[ORM\ManyToOne(targetEntity: Facture::class, inversedBy: 'ventes')]
    private $facture;

    #[ORM\ManyToOne(targetEntity: Production::class, inversedBy: 'ventes')]
    private $production;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFacture(): ?facture
    {
        return $this->facture;
    }

    public function setFacture(?facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getProduction(): ?production
    {
        return $this->production;
    }

    public function setProduction(?production $production): self
    {
        $this->production = $production;

        return $this;
    }
}
