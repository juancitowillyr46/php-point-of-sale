<?php
namespace App\Shared\Domain\Repository;

interface RepositoryInterface
{
    public function add(array $request): bool;
    public function edit(array $request, int $id): bool;
    public function remove(int $id): bool;
    public function find(int $id): array;
    public function all(?array $query): array;
    public function findByUuid(string $uuid): ?int;
}