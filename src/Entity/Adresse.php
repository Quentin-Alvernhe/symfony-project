<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Syndicat;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $ligne_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ligne_2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ligne_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $departement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_pays = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pays = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    #[ORM\ManyToMany(targetEntity: Syndicat::class, inversedBy: 'adresses')]
    #[ORM\JoinTable(name: 'adresse_syndicat')]
    private Collection $syndicats;

    public function __construct()
    {
        $this->syndicats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLigne1(): ?string
    {
        return $this->ligne_1;
    }

    public function setLigne1(string $ligne_1): static
    {
        $this->ligne_1 = $ligne_1;
        return $this;
    }

    public function getLigne2(): ?string
    {
        return $this->ligne_2;
    }

    public function setLigne2(?string $ligne_2): static
    {
        $this->ligne_2 = $ligne_2;
        return $this;
    }

    public function getLigne3(): ?string
    {
        return $this->ligne_3;
    }

    public function setLigne3(?string $ligne_3): static
    {
        $this->ligne_3 = $ligne_3;
        return $this;
    }

    public function __toString(): string
    {
        return $this->ligne_1 . ' - ' . $this->ville ?? '';
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;
        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;
        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;
        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): static
    {
        $this->departement = $departement;
        return $this;
    }

    public function getCodePays(): ?string
    {
        return $this->code_pays;
    }

    public function setCodePays(string $code_pays): static
    {
        $this->code_pays = $code_pays;
        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;
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

    /**
     * @return Collection<int, Syndicat>
     */
    public function getSyndicats(): Collection
    {
        return $this->syndicats;
    }

    public function setSyndicats (Collection $syndicats): static
    {
        $this->syndicats = $syndicats;
        return $this;
    }

    public function addSyndicat(Syndicat $syndicat): static
    {
        if (!$this->syndicats->contains($syndicat)) {
            $this->syndicats->add($syndicat);
            $syndicat->addAdresse($this);
        }

        return $this;
    }

    public function removeSyndicat(Syndicat $syndicat): static
    {
        if ($this->syndicats->removeElement($syndicat)) {
            $syndicat->removeAdresse($this);
        }

        return $this;
    }

}