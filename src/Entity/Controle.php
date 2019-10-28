<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControleRepository")
 */
class Controle
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
    private $libelle;

    /**
     * @ORM\Column(type="date")
     */
    private $dateControle;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\NoteControle", mappedBy="controles", cascade={"persist", "remove"})
     */
    private $noteControle;

    public function __toString(): string
    {
        return (string) $this->libelle;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDateControle(): ?\DateTimeInterface
    {
        return $this->dateControle;
    }

    public function setDateControle(\DateTimeInterface $dateControle): self
    {
        $this->dateControle = $dateControle;

        return $this;
    }

    public function getNoteControle(): ?NoteControle
    {
        return $this->noteControle;
    }

    public function setNoteControle(NoteControle $noteControle): self
    {
        $this->noteControle = $noteControle;

        // set the owning side of the relation if necessary
        if ($this !== $noteControle->getControles()) {
            $noteControle->setControles($this);
        }

        return $this;
    }
}