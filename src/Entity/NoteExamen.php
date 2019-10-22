<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteExamenRepository")
 */
class NoteExamen
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $note;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Examen", inversedBy="noteExamen", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $exemens;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="noteExamens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matieres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eleve", inversedBy="noteExamens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eleves;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getExemens(): ?examen
    {
        return $this->exemens;
    }

    public function setExemens(examen $exemens): self
    {
        $this->exemens = $exemens;

        return $this;
    }

    public function getMatieres(): ?matiere
    {
        return $this->matieres;
    }

    public function setMatieres(?matiere $matieres): self
    {
        $this->matieres = $matieres;

        return $this;
    }

    public function getEleves(): ?eleve
    {
        return $this->eleves;
    }

    public function setEleves(?eleve $eleves): self
    {
        $this->eleves = $eleves;

        return $this;
    }
}