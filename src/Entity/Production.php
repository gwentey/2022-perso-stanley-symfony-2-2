<?php

namespace App\Entity;

use App\Repository\ProductionRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:production:getAllProduction"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:production:getAllProduction"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: ProductionRepository::class)]
class Production
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:production:getAllProduction"])]
    private $id;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:production:getAllProduction"])]
    private $temperature;

    #[ORM\Column(type: 'date')]
    #[Groups(["read:production:getAllProduction"])]
    private $dateFabrication;

    #[ORM\Column(type: 'date')]
    #[Groups(["read:production:getAllProduction"])]
    private $datePeremption;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:production:getAllProduction"])]
    private $quantite;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:production:getAllProduction"])]
    private $conditionnement;

    #[ORM\Column]
    #[Groups(["read:production:getAllProduction"])]
    private ?float $prixParPortion = null;

    #[ORM\ManyToOne(targetEntity: Professeur::class, inversedBy: 'productions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read:production:getAllProduction"])]
    private $professeur;

    #[ORM\ManyToOne(targetEntity: Atelier::class, inversedBy: 'productions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read:production:getAllProduction"])]
    private $atelier;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'productions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read:production:getAllProduction"])]
    private $classe;

    #[ORM\OneToMany(mappedBy: 'production', targetEntity: Vente::class)]
    private $ventes;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'productions')]
    #[Groups(["read:production:getAllProduction"])]
    private $produit;

    #[ORM\OneToMany(mappedBy: 'Production', targetEntity: Destruction::class)]
    private Collection $destructions;

    #[ORM\OneToMany(mappedBy: 'Production', targetEntity: Transfert::class)]
    private Collection $transferts;

    #[ORM\Column]
    #[Groups(["read:production:getAllProduction"])]
    private ?bool $congelation = null;

    public function __construct()
    {
        $this->ventes = new ArrayCollection();
        $this->destructions = new ArrayCollection();
        $this->transferts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getDateFabrication(): ?\DateTimeInterface
    {
        return $this->dateFabrication;
    }

    public function setDateFabrication(\DateTimeInterface $dateFabrication): self
    {
        $this->dateFabrication = $dateFabrication;

        return $this;
    }

    public function getDatePeremption(): ?\DateTimeInterface
    {
        return $this->datePeremption;
    }

    public function setDatePeremption(\DateTimeInterface $datePeremption): self
    {
        $this->datePeremption = $datePeremption;

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

    public function getConditionnement(): ?float
    {
        return $this->conditionnement;
    }

    public function setConditionnement(float $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

    public function getProfesseur(): ?professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?professeur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getAtelier(): ?atelier
    {
        return $this->atelier;
    }

    public function setAtelier(?atelier $atelier): self
    {
        $this->atelier = $atelier;

        return $this;
    }

    public function getClasse(): ?classe
    {
        return $this->classe;
    }

    public function setClasse(?classe $classe): self
    {
        $this->classe = $classe;

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
            $vente->setProduction($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): self
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getProduction() === $this) {
                $vente->setProduction(null);
            }
        }

        return $this;
    }

    public function getProduit(): ?produit
    {
        return $this->produit;
    }

    public function setProduit(?produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * @return Collection<int, Destruction>
     */
    public function getDestructions(): Collection
    {
        return $this->destructions;
    }

    public function addDestruction(Destruction $destruction): self
    {
        if (!$this->destructions->contains($destruction)) {
            $this->destructions->add($destruction);
            $destruction->setProduction($this);
        }

        return $this;
    }

    public function removeDestruction(Destruction $destruction): self
    {
        if ($this->destructions->removeElement($destruction)) {
            // set the owning side to null (unless already changed)
            if ($destruction->getProduction() === $this) {
                $destruction->setProduction(null);
            }
        }

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
            $this->transferts->add($transfert);
            $transfert->setProduction($this);
        }

        return $this;
    }

    public function removeTransfert(Transfert $transfert): self
    {
        if ($this->transferts->removeElement($transfert)) {
            // set the owning side to null (unless already changed)
            if ($transfert->getProduction() === $this) {
                $transfert->setProduction(null);
            }
        }

        return $this;
    }

    public function getPrixParPortion(): ?float
    {
        return $this->prixParPortion;
    }

    public function setPrixParPortion(float $prixParPortion): self
    {
        $this->prixParPortion = $prixParPortion;

        return $this;
    }

    public function isCongelation(): ?bool
    {
        return $this->congelation;
    }

    public function setCongelation(bool $congelation): self
    {
        $this->congelation = $congelation;

        return $this;
    }
}
