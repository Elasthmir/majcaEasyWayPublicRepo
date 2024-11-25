<?php

namespace App\Service;

interface TopicHandlerInterface
{
    public function supports(string $topic): bool;

    public function handle(): array;
}
