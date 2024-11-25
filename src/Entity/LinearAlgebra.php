<?php

namespace App\Entity;

use App\Repository\LinearAlgebraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinearAlgebraRepository::class)]
class LinearAlgebra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $answear = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswear(): ?string
    {
        return $this->answear;
    }

    public function setAnswear(?string $answear): static
    {
        $this->answear = $answear;

        return $this;
    }
}
