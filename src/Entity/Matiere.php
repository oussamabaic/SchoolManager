<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatiereRepository")
 */
class Matiere
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
    private $nomMatiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $coef;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteExamen", mappedBy="matieres")
     */
    private $noteExamens;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteControle", mappedBy="matiers")
     */
    private $noteControles;

    public function __construct()
    {
        $this->noteExamens = new ArrayCollection();
        $this->noteControles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMatiere(): ?string
    {
        return $this->nomMatiere;
    }

    public function setNomMatiere(string $nomMatiere): self
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    public function getCoef(): ?int
    {
        return $this->coef;
    }

    public function setCoef(int $coef): self
    {
        $this->coef = $coef;

        return $this;
    }

    /**
     * @return Collection|NoteExamen[]
     */
    public function getNoteExamens(): Collection
    {
        return $this->noteExamens;
    }

    public function addNoteExamen(NoteExamen $noteExamen): self
    {
        if (!$this->noteExamens->contains($noteExamen)) {
            $this->noteExamens[] = $noteExamen;
            $noteExamen->setMatieres($this);
        }

        return $this;
    }

    public function removeNoteExamen(NoteExamen $noteExamen): self
    {
        if ($this->noteExamens->contains($noteExamen)) {
            $this->noteExamens->removeElement($noteExamen);
            // set the owning side to null (unless already changed)
            if ($noteExamen->getMatieres() === $this) {
                $noteExamen->setMatieres(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NoteControle[]
     */
    public function getNoteControles(): Collection
    {
        return $this->noteControles;
    }

    public function addNoteControle(NoteControle $noteControle): self
    {
        if (!$this->noteControles->contains($noteControle)) {
            $this->noteControles[] = $noteControle;
            $noteControle->setMatiers($this);
        }

        return $this;
    }

    public function removeNoteControle(NoteControle $noteControle): self
    {
        if ($this->noteControles->contains($noteControle)) {
            $this->noteControles->removeElement($noteControle);
            // set the owning side to null (unless already changed)
            if ($noteControle->getMatiers() === $this) {
                $noteControle->setMatiers(null);
            }
        }

        return $this;
    }
}
