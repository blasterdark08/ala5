<?php
// src/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $prenom;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $superAdmin;
    /**
     * @ORM\Column(name="giroupy", type="string", nullable=true)
     */
    protected $group;

    private $telefoonnr;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $banknr;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $woonplaats;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $voornaam;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $achternaam;

    public function __construct()
    {
        parent::__construct();
        $this->superAdmin = false;
        $this->groups = new ArrayCollection();
        // your own logic
        if (empty($this->registerDate)) {
            $this->registerDate = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function setGroup(?string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getSuperAdmin(): ?bool
    {
        return $this->superAdmin;
    }


    public function setSuperAdmin($superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }

    public function getTelefoonnr(): ?int
    {
        return $this->telefoonnr;
    }

    public function setTelefoonnr(int $telefoonnr): self
    {
        $this->telefoonnr = $telefoonnr;

        return $this;
    }

    public function getBanknr(): ?string
    {
        return $this->banknr;
    }

    public function setBanknr(?string $banknr): self
    {
        $this->banknr = $banknr;

        return $this;
    }

    public function getWoonplaats(): ?string
    {
        return $this->woonplaats;
    }

    public function setWoonplaats(string $woonplaats): self
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }
}