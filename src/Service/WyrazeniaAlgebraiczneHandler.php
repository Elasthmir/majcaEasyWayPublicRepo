<?php

namespace App\Service;

use App\Repository\WyrazeniaAlgebraiczneRepository;

class WyrazeniaAlgebraiczneHandler implements TopicHandlerInterface
{
    private WyrazeniaAlgebraiczneRepository $wyrazeniaAlgebraiczneRepository;

    public function __construct(WyrazeniaAlgebraiczneRepository $wyrazeniaAlgebraiczneRepository)
    {
        $this->wyrazeniaAlgebraiczneRepository = $wyrazeniaAlgebraiczneRepository;
    }

    public function supports(string $topic): bool
    {
        return $topic === "Wyrazenia Algebraiczne";
    }

    public function handle(int $limit = 1): array
    {
        $randomRecords = $this->wyrazeniaAlgebraiczneRepository->findRandom($limit);

    if (empty($randomRecords)) {
        return [];
    }
    

    return $randomRecords;
    }
}
