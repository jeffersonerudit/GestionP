<?php

namespace App\Entity;

use App\Repository\StatutRendezVousRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRendezVousRepository::class)]
class StatutRendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Statut_Rdv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatutRdv(): ?string
    {
        return $this->Statut_Rdv;
    }

    public function setStatutRdv(string $Statut_Rdv): static
    {
        $this->Statut_Rdv = $Statut_Rdv;

        return $this;
    }
}
