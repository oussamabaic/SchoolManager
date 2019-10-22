<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamenRepository")
 */
class Examen
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
    private $dateExamen;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\NoteExamen", mappedBy="exemens", cascade={"persist", "remove"})
     */
    private $noteExamen;

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

    public function getDateExamen(): ?\DateTimeInterface
    {
        return $this->dateExamen;
    }

    public function setDateExamen(\DateTimeInterface $dateExamen): self
    {
        $this->dateExamen = $dateExamen;

        return $this;
    }

    public function getNoteExamen(): ?NoteExamen
    {
        return $this->noteExamen;
    }

    public function setNoteExamen(NoteExamen $noteExamen): self
    {
        $this->noteExamen = $noteExamen;

        // set the owning side of the relation if necessary
        if ($this !== $noteExamen->getExemens()) {
            $noteExamen->setExemens($this);
        }

        return $this;
    }
}
