<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReserveringRepository")
 */
class Reservering
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $klant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kamer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kamer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opmerking;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="date")
     */
    private $eind;

    /**
     * @ORM\Column(type="boolean")
     */
    private $betaald;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKlant(): ?User
    {
        return $this->klant;
    }

    public function setKlant(?User $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    public function getKamer(): ?Kamer
    {
        return $this->kamer;
    }

    public function setKamer(?Kamer $kamer): self
    {
        $this->kamer = $kamer;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOpmerking(): ?string
    {
        return $this->opmerking;
    }

    public function setOpmerking(?string $opmerking): self
    {
        $this->opmerking = $opmerking;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEind(): ?\DateTimeInterface
    {
        return $this->eind;
    }

    public function setEind(\DateTimeInterface $eind): self
    {
        $this->eind = $eind;

        return $this;
    }

    public function getBetaald(): ?bool
    {
        return $this->betaald;
    }

    public function setBetaald(bool $betaald): self
    {
        $this->betaald = $betaald;

        return $this;
    }
}
