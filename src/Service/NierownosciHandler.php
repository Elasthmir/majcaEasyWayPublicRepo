<?php

namespace App\Service;

use App\Repository\NierownosciRepository;

class NierownosciHandler implements TopicHandlerInterface
{
    private NierownosciRepository $nierownosciRepository;

    public function __construct(NierownosciRepository $nierownosciRepository)
    {
        $this->nierownosciRepository = $nierownosciRepository;
    }

    public function supports(string $topic): bool
    {
        return $topic === "Nierówności";
    }

    public function handle(int $limit = 1): array
    {
        $randomRecords = $this->nierownosciRepository->findRandom($limit);

    if (empty($randomRecords)) {
        return [];
    }
    

    return $randomRecords;
    }
}
