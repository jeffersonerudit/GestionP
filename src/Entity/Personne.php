<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
#[Vich\Uploadable()]
#[UniqueEntity('Photo')]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Photo = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 50)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $Societe = null;

    #[ORM\Column(length: 50)]
    private ?string $Poste = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 50)]
    private ?string $Pays = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 50)]
    private ?string $Ville = null;

    #[Assert\NotBlank()]
    #[Assert\Positive(message: 'cette valeur doit être positive.')]
    #[ORM\Column]
    private ?string $Numero = null;

    #[ORM\Column(length: 50)]
    private ?string $Mail = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DateAt = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?RelationP $Relation_P = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutP $Statut_P = null;

  

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?InteretPotentiel $Interet = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $UpdatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: "personnes", fileNameProperty: "image")]
    #[Assert\Image()]
    private ?File $imageFile = null;  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): static
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

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

    public function getNumero(): ?string
    {
        return $this->Numero;
    }

    public function setNumero(string $Numero): static
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

    public function getRelationP(): ?RelationP
    {
        return $this->Relation_P;
    }

    public function setRelationP(?RelationP $Relation_P): static
    {
        $this->Relation_P = $Relation_P;

        return $this;
    }

    public function getStatutP(): ?StatutP
    {
        return $this->Statut_P;
    }

    public function setStatutP(?StatutP $Statut_P): static
    {
        $this->Statut_P = $Statut_P;

        return $this;
    }
    
    public function getInteret(): ?InteretPotentiel
    {
        return $this->Interet;
    }

    public function setInteret(?InteretPotentiel $Interet): static
    {
        $this->Interet = $Interet;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $UpdatedAt): static
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of imageFile
     */ 
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->UpdatedAt = new \DateTimeImmutable();
        }

      
    }

}
