<?php

namespace App\Entity;

use App\Repository\MoyenDeReglementRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ["read:moyendereglement:getAllFamilleMoyenDeReglement"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:moyendereglement:getAllFamilleMoyenDeReglement"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: MoyenDeReglementRepository::class)]
class MoyenDeReglement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["read:moyendereglement:getAllFamilleMoyenDeReglement"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:moyendereglement:getAllFamilleMoyenDeReglement"])]
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
