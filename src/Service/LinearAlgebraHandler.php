<?php

namespace App\Service;

use App\Repository\LinearAlgebraRepository;

class LinearAlgebraHandler implements TopicHandlerInterface
{
    private LinearAlgebraRepository $linearAlgebraRepository;

    public function __construct(LinearAlgebraRepository $linearAlgebraRepository)
    {
        $this->linearAlgebraRepository = $linearAlgebraRepository;
    }

    public function supports(string $topic): bool
    {
        return $topic === "Algebra (równania i nierówności liniowe)";
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
