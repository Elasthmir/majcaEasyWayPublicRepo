<?php

namespace App\Service;

use App\Repository\FunkcjeRepository;

class FunkcjeHandler implements TopicHandlerInterface
{
    private FunkcjeRepository $funkcjeRepository;

    public function __construct(FunkcjeRepository $funkcjeRepository)
    {
        $this->funkcjeRepository = $funkcjeRepository;
    }

    public function supports(string $topic): bool
    {
        return $topic === "Funkcje";
    }

    public function handle(int $limit = 1): array
    {
        $randomRecords = $this->funkcjeRepository->findRandom($limit);

    if (empty($randomRecords)) {
        return [];
    }
    

    return $randomRecords;
    }
}
