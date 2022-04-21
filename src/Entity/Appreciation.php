<?php

namespace App\Entity;

use App\Repository\AppreciationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppreciationRepository::class)]
class Appreciation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $niveau;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $commentaire;

    #[ORM\Column(type: 'date')]
    private $ajouteLe;

    #[ORM\ManyToOne(targetEntity: Competence::class, inversedBy: 'appreciations')]
    private $competence;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'appreciations')]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getAjouteLe(): ?\DateTimeInterface
    {
        return $this->ajouteLe;
    }

    public function setAjouteLe(\DateTimeInterface $ajouteLe): self
    {
        $this->ajouteLe = $ajouteLe;

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
