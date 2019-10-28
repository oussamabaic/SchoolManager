<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
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
    private $nomClasse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eleve", mappedBy="classe")
     */
    private $eleves;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enseigne", mappedBy="classes")
     */
    private $enseignes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    public function __toString(): string
    {
        return (string) $this->nomClasse;
    }

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->enseignes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClasse(): ?string
    {
        return $this->nomClasse;
    }

    public function setNomClasse(string $nomClasse): self
    {
        $this->nomClasse = $nomClasse;

        return $this;
    }

    /**
     * @return Collection|eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->setClasse($this);
        }

        return $this;
    }

    public function removeElefe(eleve $elefe): self
    {
        if ($this->eleves->contains($elefe)) {
            $this->eleves->removeElement($elefe);
            // set the owning side to null (unless already changed)
            if ($elefe->getClasse() === $this) {
                $elefe->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enseigne[]
     */
    public function getEnseignes(): Collection
    {
        return $this->enseignes;
    }

    public function addEnseigne(Enseigne $enseigne): self
    {
        if (!$this->enseignes->contains($enseigne)) {
            $this->enseignes[] = $enseigne;
            $enseigne->setClasses($this);
        }

        return $this;
    }

    public function removeEnseigne(Enseigne $enseigne): self
    {
        if ($this->enseignes->contains($enseigne)) {
            $this->enseignes->removeElement($enseigne);
            // set the owning side to null (unless already changed)
            if ($enseigne->getClasses() === $this) {
                $enseigne->setClasses(null);
            }
        }

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
}