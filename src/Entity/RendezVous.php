<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom_Rdv = null;

    #[ORM\Column(length: 50)]
    private ?string $Type_Rdv = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_Rdv = null;

    #[ORM\Column(length: 50)]
    private ?string $Lieu = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DateAt = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutRendezVous $Statut_Rdv = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personne $Personne = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRdv(): ?string
    {
        return $this->Nom_Rdv;
    }

    public function setNomRdv(string $Nom_Rdv): static
    {
        $this->Nom_Rdv = $Nom_Rdv;

        return $this;
    }

    public function getTypeRdv(): ?string
    {
        return $this->Type_Rdv;
    }

    public function setTypeRdv(string $Type_Rdv): static
    {
        $this->Type_Rdv = $Type_Rdv;

        return $this;
    }

    public function getDateRdv(): ?\DateTimeInterface
    {
        return $this->Date_Rdv;
    }

    public function setDateRdv(\DateTimeInterface $Date_Rdv): static
    {
        $this->Date_Rdv = $Date_Rdv;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->Lieu;
    }

    public function setLieu(string $Lieu): static
    {
        $this->Lieu = $Lieu;

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

    public function getStatutRdv(): ?StatutRendezVous
    {
        return $this->Statut_Rdv;
    }

    public function setStatutRdv(?StatutRendezVous $Statut_Rdv): static
    {
        $this->Statut_Rdv = $Statut_Rdv;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): static
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }
}
