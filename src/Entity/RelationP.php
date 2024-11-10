<?php

namespace App\Entity;

use App\Repository\RelationPRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationPRepository::class)]
class RelationP
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Type_P = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeP(): ?string
    {
        return $this->Type_P;
    }

    public function setTypeP(string $Type_P): static
    {
        $this->Type_P = $Type_P;

        return $this;
    }
}
