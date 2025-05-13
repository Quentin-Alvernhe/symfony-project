<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Entity\Role;
use App\Entity\Syndicat;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Cet email est déjà utilisé')]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    #[ORM\Column(length: 255)]
    private ?string $password;

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getFullName(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    #[ORM\Column]
    private ?bool $active = true;

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): static
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    
    #[ORM\ManyToOne]
    private ?Role $role = null;

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;
        return $this;
    }

    public function getRoles(): array
    {
        if (!$this->getRole()) {
            return [];
        }

        return match($this->getRole()->getName()) {
            'gomed' => ['ROLE_GOMED', 'ROLE_SYNDICAT'],
            'syndicat' => ['ROLE_SYNDICAT'],
            default => [],
        };
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void {}

    #[ORM\ManyToMany(targetEntity: Syndicat::class)]
    private Collection $syndicats;

    /**
     * @return Collection<int, Syndicat>
     */
    public function getSyndicats(): Collection
    {
        return $this->syndicats;
    }

    public function addSyndicat(Syndicat $syndicat): static
    {
        if (!$this->syndicats->contains($syndicat)) {
            $this->syndicats->add($syndicat);
        }

        return $this;
    }

    public function removeSyndicat(Syndicat $syndicat): static
    {
        $this->syndicats->removeElement($syndicat);
        return $this;
    }

    public function __construct()
    {
        $this->active = true;
        $this->syndicats = new ArrayCollection();
    }


}