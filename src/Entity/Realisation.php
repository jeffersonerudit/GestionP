<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisationRepository::class)]
class Realisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Date_R = null;

    #[ORM\Column]
    private ?int $New_Client = null;

    #[ORM\Column]
    private ?int $New_Partenaire = null;

    #[ORM\Column]
    private ?int $New_Contact = null;

    #[ORM\Column]
    private ?int $Nbr_Rdv_Pris = null;

    #[ORM\Column]
    private ?int $nbr_Rdv_Conf = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DateAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateR(): ?\DateTimeImmutable
    {
        return $this->Date_R;
    }

    public function setDateR(\DateTimeImmutable $Date_R): static
    {
        $this->Date_R = $Date_R;

        return $this;
    }

    public function getNewClient(): ?int
    {
        return $this->New_Client;
    }

    public function setNewClient(int $New_Client): static
    {
        $this->New_Client = $New_Client;

        return $this;
    }

    public function getNewPartenaire(): ?int
    {
        return $this->New_Partenaire;
    }

    public function setNewPartenaire(int $New_Partenaire): static
    {
        $this->New_Partenaire = $New_Partenaire;

        return $this;
    }

    public function getNewContact(): ?int
    {
        return $this->New_Contact;
    }

    public function setNewContact(int $New_Contact): static
    {
        $this->New_Contact = $New_Contact;

        return $this;
    }

    public function getNbrRdvPris(): ?int
    {
        return $this->Nbr_Rdv_Pris;
    }

    public function setNbrRdvPris(int $Nbr_Rdv_Pris): static
    {
        $this->Nbr_Rdv_Pris = $Nbr_Rdv_Pris;

        return $this;
    }

    public function getNbrRdvConf(): ?int
    {
        return $this->nbr_Rdv_Conf;
    }

    public function setNbrRdvConf(int $nbr_Rdv_Conf): static
    {
        $this->nbr_Rdv_Conf = $nbr_Rdv_Conf;

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
}
