<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 */
class Niveau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomNiveau;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cycle", inversedBy="niveaux")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cycles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Classe", mappedBy="niveau")
     */
    private $classes;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomNiveau(): ?string
    {
        return $this->nomNiveau;
    }

    public function setNomNiveau(string $nomNiveau): self
    {
        $this->nomNiveau = $nomNiveau;

        return $this;
    }

    public function getCycles(): ?cycle
    {
        return $this->cycles;
    }

    public function setCycles(?cycle $cycles): self
    {
        $this->cycles = $cycles;

        return $this;
    }

    /**
     * @return Collection|classe[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->setNiveau($this);
        }

        return $this;
    }

    public function removeClass(classe $class): self
    {
        if ($this->classes->contains($class)) {
            $this->classes->removeElement($class);
            // set the owning side to null (unless already changed)
            if ($class->getNiveau() === $this) {
                $class->setNiveau(null);
            }
        }

        return $this;
    }
}