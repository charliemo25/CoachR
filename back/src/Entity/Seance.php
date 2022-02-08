<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SeanceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as SeanceDateAssert;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: SeanceRepository::class)]
#[SeanceDateAssert\SeanceDate()]
#[ApiResource()]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Assert\DateTime()]
    private $begin;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Assert\DateTime()]
    private $end;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private $member;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private $coach;

    #[ORM\Column(type: 'boolean')]
    private $valid;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBegin(): ?\DateTimeInterface
    {
        return $this->begin;
    }

    public function setBegin(?\DateTimeInterface $begin): self
    {
        $this->begin = $begin;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getMember(): ?User
    {
        return $this->member;
    }

    public function setMember(?User $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getCoach(): ?User
    {
        return $this->coach;
    }

    public function setCoach(?User $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }
}
