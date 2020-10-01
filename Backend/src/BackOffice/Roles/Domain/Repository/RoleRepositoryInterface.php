<?php
namespace App\BackOffice\Roles\Domain\Repository;

interface RoleRepositoryInterface
{
    public function addRole(array $role): bool;

    public function editRole(int $id, array $role): bool;

    public function findRole(int $id): array;

    public function removeRole(int $id): bool;

    public function allRoles(array $query): object;

    public function commonRoles(): array;
}