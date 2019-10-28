<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EleveRepository")
 */
class Eleve
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tele;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="eleves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parents", inversedBy="eleves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteControle", mappedBy="eleves")
     */
    private $noteControles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteExamen", mappedBy="eleves")
     */
    private $noteExamens;

    public function __construct()
    {
        $this->noteControles = new ArrayCollection();
        $this->noteExamens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getTele(): ?string
    {
        return $this->tele;
    }

    public function setTele(string $tele): self
    {
        $this->tele = $tele;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getParents(): ?Parents
    {
        return $this->parents;
    }

    public function setParents(?Parents $parents): self
    {
        $this->parents = $parents;

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
            $noteControle->setEleves($this);
        }

        return $this;
    }

    public function removeNoteControle(NoteControle $noteControle): self
    {
        if ($this->noteControles->contains($noteControle)) {
            $this->noteControles->removeElement($noteControle);
            // set the owning side to null (unless already changed)
            if ($noteControle->getEleves() === $this) {
                $noteControle->setEleves(null);
            }
        }

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
            $noteExamen->setEleves($this);
        }

        return $this;
    }

    public function removeNoteExamen(NoteExamen $noteExamen): self
    {
        if ($this->noteExamens->contains($noteExamen)) {
            $this->noteExamens->removeElement($noteExamen);
            // set the owning side to null (unless already changed)
            if ($noteExamen->getEleves() === $this) {
                $noteExamen->setEleves(null);
            }
        }

        return $this;
    }
}