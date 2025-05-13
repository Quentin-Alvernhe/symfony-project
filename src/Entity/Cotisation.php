<?php

namespace App\Entity;

use App\Repository\CotisationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Periode;
use App\Entity\Syndicat;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Adhesion;

#[ORM\Entity(repositoryClass: CotisationRepository::class)]
class Cotisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\ManyToOne(targetEntity: Periode::class)]
    private ?Periode $periode = null;

    #[ORM\ManyToOne(targetEntity: Syndicat::class)]
    private ?Syndicat $syndicat = null;

    #[ORM\OneToMany(mappedBy: 'cotisation', targetEntity: Adhesion::class)]
    private Collection $adhesions;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    public function __construct()
    {
        $this->adhesions = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->nom ?? 'Nouvelle cotisation';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;
        return $this;
    }

    public function getPeriode(): ?Periode
    {
        return $this->periode;
    }

    public function setPeriode(?Periode $periode): static
    {
        $this->periode = $periode;
        return $this;
    }

    public function getSyndicat(): ?Syndicat
    {
        return $this->syndicat;
    }

    public function setSyndicat(?Syndicat $syndicat): static
    {
        $this->syndicat = $syndicat;
        return $this;
    }

    public function getAdhesions(): Collection
    {
        return $this->adhesions;
    }

    public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(\DateTimeImmutable $createdAt): static { $this->createdAt = $createdAt; return $this; }
    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static { $this->updatedAt = $updatedAt; return $this; }
    public function getDeletedAt(): ?\DateTimeInterface { return $this->deletedAt; }
    public function setDeletedAt(?\DateTimeInterface $deletedAt): static { $this->deletedAt = $deletedAt; return $this; }


}
