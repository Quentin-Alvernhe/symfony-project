<?php

namespace App\Entity;

use App\Repository\CentraleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Syndicat;

#[ORM\Entity(repositoryClass: CentraleRepository::class)]
class Centrale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    #[ORM\ManyToMany(targetEntity: Syndicat::class, inversedBy: 'centrales')]
    #[ORM\JoinTable(name: 'centrale_syndicat')]
    private Collection $syndicats;

    public function __construct()
{
    $this->syndicats = new ArrayCollection();
}

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSyndicats(): Collection
    {
        return $this->syndicats;
    }

    public function addSyndicat(Syndicat $syndicat): static
    {
        if (!$this->syndicats->contains($syndicat)) {
            $this->syndicats->add($syndicat);
            $syndicat->addCentrale($this);
        }

        return $this;
    }

    public function removeSyndicat(Syndicat $syndicat): static
    {
        if ($this->syndicats->removeElement($syndicat)) {
            $syndicat->removeCentrale($this);
        }

        return $this;
    }

}