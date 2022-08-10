<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\MeController;
use App\Controller\PasswordChangerController;
use App\Controller\SecurityController;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations: [
        'connexion' => [
            'path' => '/security',
            'method' => 'post',
            'controller' => SecurityController::class,
            'read' => false,
            'openapi_context' => [
                'summary'     => 'Permet de se connecter',
                'description' => "Permet de se connecter et récupérer le token JWT",
                'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema'  => [
                                'type'       => 'object',
                                'properties' =>
                                [
                                    'username' => ['type' => 'string'],
                                    'password' => ['type' => 'string'],
                                ],
                            ],
                            'example' => [
                                'username' => 'admin',
                                'password' => 'admin',
                            ],
                        ],
                    ],
                ],
                'responses' => [
                    "201" => [
                        "description" => "Retourne le token"
                    ],
                    "401" => [
                        "description" => "Identifiant ou mot de passe incorrect"
                    ]
                ]
            ],
        ],
        'me' => [
            'pagination_enabled' => false,
            'path' => '/me',
            'method' => 'get',
            'controller' => MeController::class,
            'read' => false,
            'security' => 'is_granted("ROLE_USER")'
        ],
        'changePassword' => [
            'pagination_enabled' => false,
            'path' => '/me/changepassword',
            'method' => 'put',
            'controller' => PasswordChangerController::class,
            'read' => false,
            'security' => 'is_granted("ROLE_USER")'
        ],
        'get',
        'post'
    ],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ["read:User"]]
        ],
    ],

    normalizationContext: ['groups' => ['read:User']]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:User'])]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(['read:User'])]
    private $username;

    #[ORM\Column(type: 'json')]
    #[Groups(['read:User'])]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(length: 255)]
    #[Groups(['read:User'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:User'])]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:User'])]
    private ?string $profile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getProfile(): ?string
    {
        return $this->profile;
    }

    public function setProfile(?string $profile): self
    {
        $this->profile = $profile;

        return $this;
    }
}
