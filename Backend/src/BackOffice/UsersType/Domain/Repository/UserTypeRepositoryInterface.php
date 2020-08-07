<?php
namespace App\BackOffice\UsersType\Domain\Repository;

use App\BackOffice\Users\Domain\Entities\User;
use App\BackOffice\UsersType\Domain\Entities\UserType;

interface UserTypeRepositoryInterface
{
    public function add(UserType $user): bool;

    public function edit(int $id, UserType $user): bool;

    public function find(int $id): array;

    public function remove(): bool;

    public function all(): array;

    public function findByUuid(string $uuid): ?int;
}