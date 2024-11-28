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



    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutProjet $StatutProjet = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreateAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $UpdateAt = null;

    /**
     * @var Collection<int, Personne>
     */
    #[ORM\ManyToMany(targetEntity: Personne::class)]
    private Collection $ProjetP;

    public function __construct()
    {
        $this->ProjetP = new ArrayCollection();
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

    /**
     * @return Collection<int, Personne>
     */
    public function getProjetP(): Collection
    {
        return $this->ProjetP;
    }

    public function addProjetP(Personne $projetP): static
    {
        if (!$this->ProjetP->contains($projetP)) {
            $this->ProjetP->add($projetP);
        }

        return $this;
    }

    public function removeProjetP(Personne $projetP): static
    {
        $this->ProjetP->removeElement($projetP);

        return $this;
    }

    
}
