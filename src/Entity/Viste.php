<?php

namespace App\Entity;

use App\Repository\VisteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisteRepository::class)]
class Viste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom_V = null;

    #[ORM\Column(length: 50)]
    private ?string $Prenom_V = null;

    #[ORM\Column(length: 50)]
    private ?string $Societe = null;

    #[ORM\Column(length: 50)]
    private ?string $Poste = null;

    #[ORM\Column(length: 50)]
    private ?string $Pays = null;

    #[ORM\Column(length: 50)]
    private ?string $Ville = null;

    #[ORM\Column]
    private ?int $Numero = null;

    #[ORM\Column(length: 50)]
    private ?string $Mail = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Date = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DateAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeViste $TypeViste = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?NatureVisite $NatureViste = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adresse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomV(): ?string
    {
        return $this->Nom_V;
    }

    public function setNomV(string $Nom_V): static
    {
        $this->Nom_V = $Nom_V;

        return $this;
    }

    public function getPrenomV(): ?string
    {
        return $this->Prenom_V;
    }

    public function setPrenomV(string $Prenom_V): static
    {
        $this->Prenom_V = $Prenom_V;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->Societe;
    }

    public function setSociete(string $Societe): static
    {
        $this->Societe = $Societe;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->Poste;
    }

    public function setPoste(string $Poste): static
    {
        $this->Poste = $Poste;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): static
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->Numero;
    }

    public function setNumero(int $Numero): static
    {
        $this->Numero = $Numero;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): static
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->Date;
    }

    public function setDate(\DateTimeImmutable $Date): static
    {
        $this->Date = $Date;

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

    public function getTypeViste(): ?TypeViste
    {
        return $this->TypeViste;
    }

    public function setTypeViste(?TypeViste $TypeViste): static
    {
        $this->TypeViste = $TypeViste;

        return $this;
    }

    public function getNatureViste(): ?NatureVisite
    {
        return $this->NatureViste;
    }

    public function setNatureViste(?NatureVisite $NatureViste): static
    {
        $this->NatureViste = $NatureViste;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }
}
