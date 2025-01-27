<?php

namespace App\Service;

use App\Repository\CiagiRepository;

class CiagiHandler implements TopicHandlerInterface
{
    private CiagiRepository $ciagiRepository;

    public function __construct(CiagiRepository $ciagiRepository)
    {
        $this->ciagiRepository = $ciagiRepository;
    }

    public function supports(string $topic): bool
    {
        return $topic === "Ciagi";
    }

    public function handle(int $limit = 1): array
    {
        $randomRecords = $this->ciagiRepository->findRandom($limit);

    if (empty($randomRecords)) {
        return [];
    }
    

    return $randomRecords;
    }
}
