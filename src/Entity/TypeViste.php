<?php

namespace App\Entity;

use App\Repository\TypeVisteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeVisteRepository::class)]
class TypeViste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Type_V = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeV(): ?string
    {
        return $this->Type_V;
    }

    public function setTypeV(string $Type_V): static
    {
        $this->Type_V = $Type_V;

        return $this;
    }
}
