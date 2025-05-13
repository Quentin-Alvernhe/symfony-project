<?php

namespace App\Entity;

use App\Repository\SyndicatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Adresse;
use App\Entity\Cotisation;
use App\Entity\Contact;
use App\Entity\Centrale;
use App\Entity\Secteur;
use App\Entity\Activite;
use App\Entity\Statut;
use App\Entity\Specificite;
use App\Entity\User;

#[ORM\Entity(repositoryClass: SyndicatRepository::class)]
class Syndicat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $acronyme = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\OneToMany(mappedBy: 'syndicat', targetEntity: Cotisation::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $cotisations;

    #[ORM\ManyToOne(targetEntity: Contact::class)]
    private ?Contact $contactPrincipale = null;

    #[ORM\ManyToOne(targetEntity: Contact::class)]
    private ?Contact $contactSecretariat = null;

    #[ORM\ManyToOne(targetEntity: Contact::class)]
    private ?Contact $contactComptable = null;

    #[ORM\ManyToMany(targetEntity: Centrale::class, mappedBy: 'syndicats')]
    private Collection $centrales;

    #[ORM\ManyToMany(targetEntity: Secteur::class, mappedBy: 'syndicats')]
    private Collection $secteurs;

    #[ORM\ManyToMany(targetEntity: Activite::class, mappedBy: 'syndicats')]
    private Collection $activites;

    #[ORM\ManyToMany(targetEntity: Statut::class, mappedBy: 'syndicats')]
    private Collection $statuts;

    #[ORM\ManyToMany(targetEntity: Specificite::class, mappedBy: 'syndicats')]
    private Collection $specificites;

    #[ORM\ManyToMany(targetEntity: Adresse::class, mappedBy: 'syndicats')]
    private Collection $adresses;


   /* #[ORM\ManyToMany(targetEntity: Contact::class)]
    private Collection $contacts;

    #[ORM\ManyToMany(targetEntity: User::class)]
    private Collection $utilisateurs;*/

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $banque = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomAssoDon = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    public function __construct()
    {
        $this->cotisations = new ArrayCollection();
        //$this->contacts = new ArrayCollection();
        $this->centrales = new ArrayCollection();
        $this->secteurs = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->statuts = new ArrayCollection();
        $this->specificites = new ArrayCollection();
        //$this->utilisateurs = new ArrayCollection();
        $this->adresses = new ArrayCollection();
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
         $this->nom = $nom; return $this;
    }

    public function getAcronyme(): ?string
    {
         return $this->acronyme;
    }

    public function setAcronyme(?string $acronyme): static
    {
         $this->acronyme = $acronyme; return $this;
    }

    public function getEmail(): ?string
    {
         return $this->email;
    }

    public function setEmail(?string $email): static
    {
         $this->email = $email; return $this;
    }

    public function getTelephone(): ?string
    {
         return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
         $this->telephone = $telephone; return $this;
    }

    public function getContactPrincipale(): ?Contact
    {
         return $this->contactPrincipale;
    }

    public function setContactPrincipale(?Contact $contact): static
    {
         $this->contactPrincipale = $contact; return $this;
    }

    public function getContactSecretariat(): ?Contact
    {
         return $this->contactSecretariat;
    }

    public function setContactSecretariat(?Contact $contact): static
    {
         $this->contactSecretariat = $contact; return $this;
    }

    public function getContactComptable(): ?Contact
    {
         return $this->contactComptable;
    }

    public function setContactComptable(?Contact $contact): static
    {
         $this->contactComptable = $contact; return $this;
    }

    public function getLogo(): ?string
    {
         return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
         $this->logo = $logo; return $this;
    }

    public function getBanque(): ?string
    {
         return $this->banque;
    }

    public function setBanque(?string $banque): static
    {
         $this->banque = $banque; return $this;
    }

    public function getSiret(): ?string
    {
         return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
         $this->siret = $siret; return $this;
    }

    public function getNomAssoDon(): ?string
    {
         return $this->nomAssoDon;
    }

    public function setNomAssoDon(?string $nomAssoDon): static
    {
         $this->nomAssoDon = $nomAssoDon; return $this;
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
     * @return Collection<int, Cotisation>
     */
    public function getCotisations(): Collection
    {
        return $this->cotisations;
    }

    public function addCotisation(Cotisation $cotisation): self
    {
        if (!$this->cotisations->contains($cotisation)) {
            $this->cotisations[] = $cotisation;
            $cotisation->setSyndicat($this);
        }

        return $this;
    }

    public function removeCotisation(Cotisation $cotisation): self
    {
        if ($this->cotisations->removeElement($cotisation)) {
            if ($cotisation->getSyndicat() === $this) {
                $cotisation->setSyndicat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Centrale>
     */
    public function getCentrales(): Collection
    {
        return $this->centrales;
    }

    public function setCentrales(Collection $centrales): static
    {
        $this->centrales = $centrales;
        return $this;
    }

    public function addCentrale(Centrale $centrale): static
    {
        if (!$this->centrales->contains($centrale)) {
            $this->centrales->add($centrale);
            $centrale->addSyndicat($this);
        }

        return $this;
    }

    public function removeCentrale(Centrale $centrale): static
    {
        if ($this->centrales->removeElement($centrale)) {
            $centrale->removeSyndicat($this); 
        }
        return $this;
    }

    /**
     * @return Collection<int, Secteur>
     */
    public function getSecteurs(): Collection
    {
        return $this->secteurs;
    }

    public function setSecteurs(Collection $secteurs): static
    {
        $this->secteurs = $secteurs;
        return $this;
    }

    public function addSecteur(Secteur $secteur): static
    {
        if (!$this->secteurs->contains($secteur)) {
            $this->secteurs->add($secteur);
            $secteur->addSyndicat($this);
        }

        return $this;
    }

    public function removeSecteur(Secteur $secteur): static
    {
        if ($this->secteurs->removeElement($secteur)) {
            $secteur->removeSyndicat($this); 
        }
        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function setActivites(Collection $activites): static
    {
        $this->activites = $activites;
        return $this;
    }

    public function addActivite(Activite $activite): static
    {
        if (!$this->activites->contains($activite)) {
            $this->activites->add($activite);
            $activite->addSyndicat($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): static
    {
        if ($this->activites->removeElement($activite)) {
            $activite->removeSyndicat($this); 
        }
        return $this;
    }

    /**
     * @return Collection<int, Statut>
     */
    public function getStatuts(): Collection
    {
        return $this->statuts;
    }

    public function setStatuts(Collection $statuts): static
    {
        $this->statuts = $statuts;
        return $this;
    }

    public function addStatut(Statut $statut): static
    {
        if (!$this->statuts->contains($statut)) {
            $this->statuts->add($statut);
            $statut->addSyndicat($this);
        }

        return $this;
    }

    public function removeStatut(Statut $statut): static
    {
        if ($this->statuts->removeElement($statut)) {
            $statut->removeSyndicat($this); 
        }
        return $this;
    }

    /**
     * @return Collection<int, Specificite>
     */
    public function getSpecificites(): Collection
    {
        return $this->specificites;
    }

    public function setSpecificites(Collection $specificites): static
    {
        $this->specificites = $specificites;
        return $this;
    }

    public function addSpecificite(Specificite $specificite): static
    {
        if (!$this->specificites->contains($specificite)) {
            $this->specificites->add($specificite);
            $specificite->addSyndicat($this);
        }

        return $this;
    }

    public function removeSpecificite(Specificite $specificite): static
    {
        if ($this->specificites->removeElement($specificite)) {
            $specificite->removeSyndicat($this); 
        }
        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function setAdresses(Collection $adresses): static
    {
        $this->adresses = $adresses;
        return $this;
    }

    public function addAdresse(Adresse $adresse): static
    {
        if (!$this->adresses->contains($adresse)) {
            $this->adresses->add($adresse);
            $adresse->addSyndicat($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): static
    {
        if ($this->adresses->removeElement($adresse)) {
            $adresse->removeSyndicat($this); 
        }
        return $this;
    }

}