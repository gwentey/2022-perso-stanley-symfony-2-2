<?php

namespace App\Entity;

use App\Repository\MoyenDeReglementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MoyenDeReglementRepository::class)]
class MoyenDeReglement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["getAllMoyenDeReglement"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["getAllMoyenDeReglement"])]
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
