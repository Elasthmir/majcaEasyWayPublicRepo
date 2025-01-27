<?php

namespace App\Service;

use App\Repository\LiczbyRzeczywisteRepository;

class LiczbyRzeczywisteHandler implements TopicHandlerInterface
{
    private LiczbyRzeczywisteRepository $liczbyRzeczywisteRepository;

    public function __construct(LiczbyRzeczywisteRepository $liczbyRzeczywisteRepository)
    {
        $this->liczbyRzeczywisteRepository = $liczbyRzeczywisteRepository;
    }

    public function supports(string $topic): bool
    {
        return $topic === "Liczby Rzeczywiste";
    }

    public function handle(int $limit = 1): array
    {
        $randomRecords = $this->liczbyRzeczywisteRepository->findRandom($limit);

    if (empty($randomRecords)) {
        return [];
    }
    

    return $randomRecords;
    }
}
