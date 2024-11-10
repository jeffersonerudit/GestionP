<?php

namespace App\Entity;

use App\Repository\NatureVisiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NatureVisiteRepository::class)]
class NatureVisite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nature_V = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNatureV(): ?string
    {
        return $this->Nature_V;
    }

    public function setNatureV(string $Nature_V): static
    {
        $this->Nature_V = $Nature_V;

        return $this;
    }
}
