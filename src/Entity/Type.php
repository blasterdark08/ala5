<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantalPersonen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $omschrijving;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAantalPersonen(): ?int
    {
        return $this->aantalPersonen;
    }

    public function setAantalPersonen(int $aantalPersonen): self
    {
        $this->aantalPersonen = $aantalPersonen;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }
    public function __toString() {
        return $this->getAantalPersonen(). 'personen - ' . $this->getOmschrijving();
    }
}
