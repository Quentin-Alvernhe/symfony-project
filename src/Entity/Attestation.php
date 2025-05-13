<?php

namespace App\Entity;

use App\Entity\Adhesion;
use App\Repository\AttestationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AttestationRepository::class)]
class Attestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $fichier = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $size;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $original_name = null;

    #[ORM\Column(length: 255)]
    private ?string $type_attestation = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    #[ORM\ManyToOne(targetEntity: Adhesion::class)]
    private ?Adhesion $adhesion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): static
    {
        $this->fichier = $fichier;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): static
    {
        $this->size = $size;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function setOriginalName(string $original_name): static
    {
        $this->original_name = $original_name;
        return $this;
    }

    public function getTypeAttestation(): ?string
    {
        return $this->type_attestation;
    }

    public function setTypeAttestation(string $type_attestation): static
    {
        $this->type_attestation = $type_attestation;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface 
    {
         return $this->updatedAt;
    }
    
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static 
    {
         $this->updatedAt = $updatedAt; return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): static
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    public function getAdhesion(): ?Adhesion
    {
        return $this->adhesion;
    }

    public function setAdhesion(?Adhesion $adhesion): static
    {
        $this->adhesion = $adhesion;
        return $this;
    }

}