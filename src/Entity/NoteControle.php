<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteControleRepository")
 */
class NoteControle
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="noteControles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiers;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Controle", inversedBy="noteControle", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $controles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eleve", inversedBy="noteControles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eleves;

    public function __toString(): string
    {
        return (string) $this->note;
    }

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

    public function getMatiers(): ?matiere
    {
        return $this->matiers;
    }

    public function setMatiers(?matiere $matiers): self
    {
        $this->matiers = $matiers;

        return $this;
    }

    public function getControles(): ?controle
    {
        return $this->controles;
    }

    public function setControles(controle $controles): self
    {
        $this->controles = $controles;

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