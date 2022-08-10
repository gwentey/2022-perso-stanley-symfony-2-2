<?php

namespace App\Entity;

use App\Repository\TransfertRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:transfert:getAllTransfert"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:transfert:getAllTransfert"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: TransfertRepository::class)]
class Transfert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["read:transfert:getAllTransfert"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:transfert:getAllTransfert"])]
    private $quantite;

    #[ORM\Column(type: 'date')]
    #[Groups(["read:transfert:getAllTransfert"])]
    private $date_transfert;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:transfert:getAllTransfert"])]
    private $prix_unitaire;

    #[ORM\ManyToOne(targetEntity: TypeTransfert::class, inversedBy: 'transferts')]
    #[ORM\JoinColumn(nullable: false)]
    private $type_transfert;

    #[ORM\ManyToOne(inversedBy: 'transferts')]
    private ?Production $Production = null;


    public function __construct()
    {
        $this->productions = new ArrayCollection();
    }

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

    public function getDateTransfert(): ?\DateTimeInterface
    {
        return $this->date_transfert;
    }

    public function setDateTransfert(\DateTimeInterface $date_transfert): self
    {
        $this->date_transfert = $date_transfert;

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

    public function getTypeTransfert(): ?TypeTransfert
    {
        return $this->type_transfert;
    }

    public function setTypeTransfert(?TypeTransfert $type_transfert): self
    {
        $this->type_transfert = $type_transfert;

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
