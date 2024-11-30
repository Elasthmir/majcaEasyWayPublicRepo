<?php

namespace App\Service;

use App\Repository\LinearFunctionRepository;

class LinearFunctionHandler implements TopicHandlerInterface
{
    private LinearFunctionRepository $linearAlgebraRepository;

    public function __construct(LinearFunctionRepository $linearAlgebraRepository)
    {
        $this->linearAlgebraRepository = $linearAlgebraRepository;
    }

    public function supports(string $topic): bool
    {
        return $topic === "Funkcja Liniowa";
    }

    public function handle(int $limit = 1): array
    {
        $randomRecords = $this->linearAlgebraRepository->findRandom($limit);

    if (empty($randomRecords)) {
        return [];
    }
    

    return $randomRecords;
    }
}
