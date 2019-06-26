<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
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
    private $aantal;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $prijs;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     */
    private $totaal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getPrijs()
    {
        return $this->prijs;
    }

    public function setPrijs($prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getTotaal()
    {
        return $this->totaal;
    }

    public function setTotaal($totaal): self
    {
        $this->totaal = $totaal;

        return $this;
    }
}
