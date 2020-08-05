<?php
namespace App\BackOffice\Users\Domain\Repository;

use App\BackOffice\Users\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function add(User $user): bool;

    public function edit(int $id, User $user): bool;

    public function find(int $id): object;

    public function remove(): bool;

    public function all(): array;

    public function findByUuid(string $uuid): object;
}