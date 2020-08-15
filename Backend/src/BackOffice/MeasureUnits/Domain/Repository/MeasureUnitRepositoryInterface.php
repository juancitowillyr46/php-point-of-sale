<?php
namespace App\BackOffice\MeasureUnits\Domain\Repository;

use App\BackOffice\Users\Domain\Entities\User;

interface MeasureUnitRepositoryInterface
{
    public function add(User $user): bool;

    public function edit(int $id, User $user): bool;

    public function find(int $id): array;

    public function remove(): bool;

    public function all(): array;

    public function findByUuid(string $uuid): ?int;
}