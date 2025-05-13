<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Adresse;
use App\Entity\Syndicat;
use App\Entity\Centrale;
use App\Entity\Secteur;
use App\Entity\Activite;
use App\Entity\Statut;
use App\Entity\Specificite;
use App\Entity\Adhesion;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $emailPro = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $emailPerso = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephonePortablePro = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephonePortablePerso = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreSalarie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rpps = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $dateRetraite = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $anneeInstallation = null;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Adhesion::class)]
    private Collection $adhesions;

    #[ORM\ManyToOne(targetEntity: Centrale::class)]
    private ?Centrale $centrale = null;

    #[ORM\ManyToOne(targetEntity: Secteur::class)]
    private ?Secteur $secteur = null;

    #[ORM\ManyToMany(targetEntity: Statut::class)]
    private Collection $statuts;

    #[ORM\ManyToMany(targetEntity: Activite::class)]
    private Collection $activites;

    #[ORM\ManyToMany(targetEntity: Specificite::class)]
    private Collection $specificites;

    #[ORM\ManyToMany(targetEntity: Adresse::class)]
    private Collection $adresses;

    #[ORM\ManyToMany(targetEntity: Syndicat::class)]
    private Collection $syndicats;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    public function __construct()
    {
        $this->adhesions = new ArrayCollection();
        $this->specificites = new ArrayCollection();
        $this->statuts = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->syndicats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = strtoupper($nom); // Nom en MAJUSCULES
        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getEmailPro(): ?string
    {
        return $this->emailPro;
    }

    public function setEmailPro(string $emailPro): static
    {
        $this->emailPro = $emailPro;
        return $this;
    }

    public function getEmailPerso(): ?string
    {
        return $this->emailPerso;
    }

    public function setEmailPerso(string $emailPerso): static
    {
        $this->emailPerso = $emailPerso;
        return $this;
    }

    public function getTelephonePortablePro(): ?string
    {
        return $this->telephonePortablePro;
    }

    public function setTelephonePortablePro(?string $telephonePortablePro): static
    {
        $this->telephonePortablePro = $telephonePortablePro;
        return $this;
    }

    public function getTelephonePortablePerso(): ?string
    {
        return $this->telephonePortablePerso;
    }

    public function setTelephonePortablePerso(?string $telephonePortablePerso): static
    {
        $this->telephonePortablePerso = $telephonePortablePerso;
        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
        $this->siret = $siret;
        return $this;
    }

    public function getNombreSalarie(): ?int
    {
        return $this->nombreSalarie;
    }

    public function setNombreSalarie(?int $nombreSalarie): static
    {
        $this->nombreSalarie = $nombreSalarie;
        return $this;
    }

    public function getRpps(): ?string
    {
        return $this->rpps;
    }

    public function setRpps(?string $rpps): static
    {
        $this->rpps = $rpps;
        return $this;
    }

    public function getDateRetraite(): ?\DateTimeInterface
    {
        return $this->dateRetraite;
    }

    public function setDateRetraite(?\DateTimeInterface $dateRetraite): static
    {
        $this->dateRetraite = $dateRetraite;
        return $this;
    }

    public function getAnneeInstallation(): ?\DateTimeInterface
    {
        return $this->anneeInstallation;
    }

    public function setAnneeInstallation(?\DateTimeInterface $anneeInstallation): static
    {
        $this->anneeInstallation = $anneeInstallation;
        return $this;
    }


    public function getCentrale(): ?Centrale
    {
        return $this->centrale;
    }

    public function setCentrale(?Centrale $centrale): static
    {
        $this->centrale = $centrale;
        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): static
    {
        $this->secteur = $secteur;
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

    /**
     * @return Collection<int, Specificite>
     */
    public function getSpecificites(): Collection
    {
        return $this->specificites;
    }

    public function addSpecificite(Specificite $specificite): static
    {
        if (!$this->specificites->contains($specificite)) {
            $this->specificites->add($specificite);
        }

        return $this;
    }

    public function removeSpecificite(Specificite $specificite): static
    {
        $this->specificites->removeElement($specificite);
        return $this;
    }

    /**
     * @return Collection<int, Adhesion>
     */
    public function getAdhesions(): Collection
    {
        return $this->adhesions;
    }

    public function addAdhesion(Adhesion $adhesion): static
    {
        if (!$this->adhesions->contains($adhesion)) {
            $this->adhesions->add($adhesion);
            $adhesion->setContact($this);
        }

        return $this;
    }

    public function removeAdhesion(Adhesion $adhesion): static
    {
        $this->adhesions->removeElement($adhesion);
        return $this;
    }

    /**
     * @return Collection<int, Statut>
     */
    public function getStatuts(): Collection
    {
        return $this->statuts;
    }

    public function addStatut(Statut $statut): static
    {
        if (!$this->statuts->contains($statut)) {
            $this->statuts->add($statut);
        }

        return $this;
    }

    public function removeStatut(Statut $statut): static
    {
        $this->statuts->removeElement($statut);
        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): static
    {
        if (!$this->activites->contains($activite)) {
            $this->activites->add($activite);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): static
    {
        $this->activites->removeElement($activite);
        return $this;
    }

    /**
     * @return Collection<int, Adressee>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdresse(Adresse $adresse): static
    {
        if (!$this->adresses->contains($adresse)) {
            $this->adresses->add($adresse);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): static
    {
        $this->adresses->removeElement($adresse);
        return $this;
    }

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

}
