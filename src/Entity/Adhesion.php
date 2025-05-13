<?php

namespace App\Entity;

use App\Repository\AdhesionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Contact;
use App\Entity\Periode;
use App\Entity\Cotisation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Attestation;

#[ORM\Entity(repositoryClass: AdhesionRepository::class)]
class Adhesion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Contact::class)]
    private ?Contact $contact = null;

    #[ORM\ManyToOne(targetEntity: Periode::class)]
    private ?Periode $periode = null;

    #[ORM\ManyToOne(targetEntity: Cotisation::class)]
    private ?Cotisation $cotisation = null;

    #[ORM\Column(nullable: true)]
    private ?int $montantDon = null;

    #[ORM\OneToMany(mappedBy: 'adhesion', targetEntity: Attestation::class)]
    private Collection $attestations;

    #[ORM\OneToMany(mappedBy: 'adhesion', targetEntity: Attestation::class)]
    private Collection $attestationsDons;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    public function __construct()
    {
        $this->attestations = new ArrayCollection();
        $this->attestationsDons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): static
    {
        $this->contact = $contact;
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

    public function getCotisation(): ?Cotisation
    {
        return $this->cotisation;
    }

    public function setCotisation(?Cotisation $cotisation): self
    {
    $this->cotisation = $cotisation;
    return $this;
}

    public function getMontantDon(): ?int
    {
        return $this->montantDon;
    }

    public function setMontantDon(?int $montantDon): static
    {
        $this->montantDon = $montantDon;
        return $this;
    }

    public function getAttestations(): Collection
    {
        return $this->attestations;
    }

    public function addAttestation(Attestation $attestation): static
    {
        if (!$this->attestations->contains($attestation)) {
            $this->attestations->add($attestation);
            $attestation->setAdhesion($this);
        }

        return $this;
    }

    public function removeAttestation(Attestation $attestation): static
    {
        $this->attestations->removeElement($attestation);
        return $this;
    }

    public function getAttestationsDons(): Collection
    {
        return $this->attestationsDons;
    }

    public function addAttestationsDon(Attestation $attestation): static
    {
        if (!$this->attestationsDons->contains($attestation)) {
            $this->attestationsDons->add($attestation);
            $attestation->setAdhesion($this);
        }

        return $this;
    }

    public function removeAttestationsDon(Attestation $attestation): static
    {
        $this->attestationsDons->removeElement($attestation);
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable 
    {
         return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static 
    {
         $this->createdAt = $createdAt; return $this;
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
         $this->deletedAt = $deletedAt; return $this;
    }



}
