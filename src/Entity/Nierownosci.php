<?php

namespace App\Entity;

use App\Repository\NierownosciRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NierownosciRepository::class)]
class Nierownosci
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $answear = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $answer_bad_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $answer_bad_2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $answer_bad_3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $command = null;

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

    public function getAnswerBad1(): ?string
    {
        return $this->answer_bad_1;
    }

    public function setAnswerBad1(?string $answer_bad_1): static
    {
        $this->answer_bad_1 = $answer_bad_1;

        return $this;
    }

    public function getAnswerBad2(): ?string
    {
        return $this->answer_bad_2;
    }

    public function setAnswerBad2(?string $answer_bad_2): static
    {
        $this->answer_bad_2 = $answer_bad_2;

        return $this;
    }

    public function getAnswerBad3(): ?string
    {
        return $this->answer_bad_3;
    }

    public function setAnswerBad3(?string $answer_bad_3): static
    {
        $this->answer_bad_3 = $answer_bad_3;

        return $this;
    }

    public function getCommand(): ?string
    {
        return $this->command;
    }

    public function setCommand(?string $command): static
    {
        $this->command = $command;

        return $this;
    }
}
