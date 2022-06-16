<?php

namespace App\Entity;

use App\Repository\ProductionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionRepository::class)]
class Production
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["getAllProduction"])]
    private $id;

    #[ORM\Column(type: 'float')]
    #[Groups(["getAllProduction"])]
    private $temperature;

    #[ORM\Column(type: 'date')]
    #[Groups(["getAllProduction"])]
    private $date_fabrication;

    #[ORM\Column(type: 'date')]
    #[Groups(["getAllProduction"])]
    private $date_peremption;

    #[ORM\Column(type: 'float')]
    #[Groups(["getAllProduction"])]
    private $quantite;

    #[ORM\Column(type: 'float')]
    #[Groups(["getAllProduction"])]
    private $conditionnement;

    #[ORM\ManyToOne(targetEntity: Professeur::class, inversedBy: 'productions')]
    #[ORM\JoinColumn(nullable: false)]
    private $professeur;

    #[ORM\ManyToOne(targetEntity: Atelier::class, inversedBy: 'productions')]
    #[ORM\JoinColumn(nullable: false)]
    private $atelier;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'productions')]
    #[ORM\JoinColumn(nullable: false)]
    private $classe;

    #[ORM\ManyToOne(targetEntity: Destruction::class, inversedBy: 'productions')]
    private $destruction;

    #[ORM\ManyToOne(targetEntity: Transfert::class, inversedBy: 'productions')]
    private $transfert;

    #[ORM\OneToMany(mappedBy: 'production', targetEntity: Vente::class)]
    private $ventes;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'productions')]
    private $produit;

    public function __construct()
    {
        $this->ventes = new ArrayCollection();
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
        return $this->date_fabrication;
    }

    public function setDateFabrication(\DateTimeInterface $date_fabrication): self
    {
        $this->date_fabrication = $date_fabrication;

        return $this;
    }

    public function getDatePeremption(): ?\DateTimeInterface
    {
        return $this->date_peremption;
    }

    public function setDatePeremption(\DateTimeInterface $date_peremption): self
    {
        $this->date_peremption = $date_peremption;

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

    public function getDestruction(): ?destruction
    {
        return $this->destruction;
    }

    public function setDestruction(?destruction $destruction): self
    {
        $this->destruction = $destruction;

        return $this;
    }

    public function getTransfert(): ?transfert
    {
        return $this->transfert;
    }

    public function setTransfert(?transfert $transfert): self
    {
        $this->transfert = $transfert;

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
}
