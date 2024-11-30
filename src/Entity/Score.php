<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    private ?UserMakerBundle $user_id = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column(length: 255)]
    private ?string $topic = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    private ?MathTopics $topic_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?UserMakerBundle
    {
        return $this->user_id;
    }

    public function setUserId(?UserMakerBundle $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): static
    {
        $this->topic = $topic;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTopicId(): ?MathTopics
    {
        return $this->topic_id;
    }

    public function setTopicId(?MathTopics $topic_id): static
    {
        $this->topic_id = $topic_id;

        return $this;
    }
}
