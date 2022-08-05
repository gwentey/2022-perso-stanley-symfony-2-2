<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategorieClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    normalizationContext: ['groups' => ["read:categorieclient:getAllCategorieClient"]],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:categorieclient:getAllCategorieClient"]]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: CategorieClientRepository::class)]
class CategorieClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:categorieclient:getAllCategorieClient"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:categorieclient:getAllCategorieClient"])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Client::class, orphanRemoval: true)]
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
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
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setCategorie($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getCategorie() === $this) {
                $client->setCategorie(null);
            }
        }

        return $this;
    }
}
