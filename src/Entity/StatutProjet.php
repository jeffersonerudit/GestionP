<?php

namespace App\Entity;

use App\Repository\StatutProjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutProjetRepository::class)]
class StatutProjet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Statut_P = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatutP(): ?string
    {
        return $this->Statut_P;
    }

    public function setStatutP(string $Statut_P): static
    {
        $this->Statut_P = $Statut_P;

        return $this;
    }
}
