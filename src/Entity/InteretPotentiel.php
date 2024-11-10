<?php

namespace App\Entity;

use App\Repository\InteretPotentielRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InteretPotentielRepository::class)]
class InteretPotentiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Interet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInteret(): ?string
    {
        return $this->Interet;
    }

    public function setInteret(string $Interet): static
    {
        $this->Interet = $Interet;

        return $this;
    }
}
