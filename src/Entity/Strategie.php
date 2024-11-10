<?php

namespace App\Entity;

use App\Repository\StrategieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StrategieRepository::class)]
class Strategie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom_Strategie = null;

    #[ORM\Column]
    private ?int $Budget = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DateAt = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personne $Personne = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $UpdatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $Enveloppe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStrategie(): ?string
    {
        return $this->Nom_Strategie;
    }

    public function setNomStrategie(string $Nom_Strategie): static
    {
        $this->Nom_Strategie = $Nom_Strategie;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->Budget;
    }

    public function setBudget(int $Budget): static
    {
        $this->Budget = $Budget;

        return $this;
    }

    public function getDateAt(): ?\DateTimeImmutable
    {
        return $this->DateAt;
    }

    public function setDateAt(\DateTimeImmutable $DateAt): static
    {
        $this->DateAt = $DateAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->Personne;
    }

    public function setPersonne(?Personne $Personne): static
    {
        $this->Personne = $Personne;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $UpdatedUp): static
    {
        $this->UpdatedAt = $UpdatedUp;

        return $this;
    }

    public function getEnveloppe(): ?int
    {
        return $this->Enveloppe;
    }

    public function setEnveloppe(?int $Enveloppe): static
    {
        $this->Enveloppe = $Enveloppe;

        return $this;
    }
}
