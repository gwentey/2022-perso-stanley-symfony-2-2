<?php

namespace App\Entity;

use App\Repository\UniteeProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
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
    #[Groups(["read:uniteeProduit:getAllUniteeProduit"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:uniteeProduit:getAllUniteeProduit"])]
    private $nom;

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
}
