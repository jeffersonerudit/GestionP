<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 50)]
    private ?string $Nom_Projet = null;

    #[ORM\Column(length: 255)]
    private ?string $Description_Projet = null;

    /**
     * @var Collection<int, Personne>
     */
    #[ORM\ManyToMany(targetEntity: Personne::class)]
    private Collection $Personne;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutProjet $StatutProjet = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreateAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $UpdateAt = null;

    public function __construct()
    {
        $this->Personne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomProjet(): ?string
    {
        return $this->Nom_Projet;
    }

    public function setNomProjet(string $Nom_Projet): static
    {
        $this->Nom_Projet = $Nom_Projet;

        return $this;
    }

    public function getDescriptionProjet(): ?string
    {
        return $this->Description_Projet;
    }

    public function setDescriptionProjet(string $Description_Projet): static
    {
        $this->Description_Projet = $Description_Projet;

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonne(): Collection
    {
        return $this->Personne;
    }

    public function addPersonne(Personne $personne): static
    {
        if (!$this->Personne->contains($personne)) {
            $this->Personne->add($personne);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): static
    {
        $this->Personne->removeElement($personne);

        return $this;
    }

    public function getStatutProjet(): ?StatutProjet
    {
        return $this->StatutProjet;
    }

    public function setStatutProjet(?StatutProjet $StatutProjet): static
    {
        $this->StatutProjet = $StatutProjet;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->CreateAt;
    }

    public function setCreateAt(\DateTimeImmutable $CreateAt): static
    {
        $this->CreateAt = $CreateAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->UpdateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $UpdateAt): static
    {
        $this->UpdateAt = $UpdateAt;

        return $this;
    }
}
