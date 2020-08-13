<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRDV;

    /**
     * @ORM\ManyToOne(targetEntity=Coiffeur::class, inversedBy="reservations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $coiffeur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRDV(): ?\DateTimeInterface
    {
        return $this->dateRDV;
    }

    public function setDateRDV(\DateTimeInterface $dateRDV): self
    {
        $this->dateRDV = $dateRDV;

        return $this;
    }

    public function getCoiffeur(): ?Coiffeur
    {
        return $this->coiffeur;
    }

    public function setCoiffeur(?Coiffeur $coiffeur): self
    {
        $this->coiffeur = $coiffeur;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
