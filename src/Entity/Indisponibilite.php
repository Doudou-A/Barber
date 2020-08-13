<?php

namespace App\Entity;

use App\Repository\IndisponibiliteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IndisponibiliteRepository::class)
 */
class Indisponibilite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateIndispo;

    /**
     * @ORM\ManyToOne(targetEntity=Coiffeur::class, inversedBy="indisponibilites")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $coiffeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateIndispo(): ?\DateTimeInterface
    {
        return $this->dateIndispo;
    }

    public function setDateIndispo(?\DateTimeInterface $dateIndispo): self
    {
        $this->dateIndispo = $dateIndispo;

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
}
