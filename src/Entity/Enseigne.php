<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnseigneRepository")
 */
class Enseigne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="enseignes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prof", inversedBy="enseignes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasses(): ?classe
    {
        return $this->classes;
    }

    public function setClasses(?classe $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function getProfs(): ?prof
    {
        return $this->profs;
    }

    public function setProfs(?prof $profs): self
    {
        $this->profs = $profs;

        return $this;
    }
}