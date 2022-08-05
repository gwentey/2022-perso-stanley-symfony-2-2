<?php

namespace App\Entity;

use App\Repository\TypeTransfertRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:transfert:getAllTypeTransfert"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:transfert:getAllTypeTransfert"]],
        ]
    ]
)]
#[ORM\Entity(repositoryClass: TypeTransfertRepository::class)]
class TypeTransfert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:transfert:getAllTypeTransfert"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:transfert:getAllTypeTransfert"])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'type_transfert', targetEntity: Transfert::class, orphanRemoval: true)]
    private $transferts;

    public function __construct()
    {
        $this->transferts = new ArrayCollection();
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
     * @return Collection<int, Transfert>
     */
    public function getTransferts(): Collection
    {
        return $this->transferts;
    }

    public function addTransfert(Transfert $transfert): self
    {
        if (!$this->transferts->contains($transfert)) {
            $this->transferts[] = $transfert;
            $transfert->setTypeTransfert($this);
        }

        return $this;
    }

    public function removeTransfert(Transfert $transfert): self
    {
        if ($this->transferts->removeElement($transfert)) {
            // set the owning side to null (unless already changed)
            if ($transfert->getTypeTransfert() === $this) {
                $transfert->setTypeTransfert(null);
            }
        }

        return $this;
    }
}
