<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:facture:getAllFacture"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:facture:getAllFacture"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:facture:getAllFacture"])]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Groups(["read:facture:getAllFacture"])]
    private $date_creation;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(["read:facture:getAllFacture"])]
    private $date_reglement;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'factures')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    #[ORM\OneToMany(mappedBy: 'facture', targetEntity: Vente::class)]
    private $ventes;

    public function __construct()
    {
        $this->ventes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateReglement(): ?\DateTimeInterface
    {
        return $this->date_reglement;
    }

    public function setDateReglement(\DateTimeInterface $date_reglement): self
    {
        $this->date_reglement = $date_reglement;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Vente>
     */
    public function getVentes(): Collection
    {
        return $this->ventes;
    }

    public function addVente(Vente $vente): self
    {
        if (!$this->ventes->contains($vente)) {
            $this->ventes[] = $vente;
            $vente->setFacture($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): self
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getFacture() === $this) {
                $vente->setFacture(null);
            }
        }

        return $this;
    }
}
