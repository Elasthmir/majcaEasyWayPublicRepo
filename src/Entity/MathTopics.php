<?php

namespace App\Entity;

use App\Repository\MathTopicsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MathTopicsRepository::class)]
class MathTopics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $topicName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTopicName(): ?string
    {
        return $this->topicName;
    }

    public function setTopicName(?string $topicName): static
    {
        $this->topicName = $topicName;

        return $this;
    }
}
