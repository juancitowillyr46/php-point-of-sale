<?php
namespace App\BackOffice\Permissions\Domain\Repository;

interface PermissionRepositoryInterface
{
    public function addPermission(array $permission): bool;

    public function editPermission(int $id, array $permission): bool;

    public function findPermission(int $id): array;

    public function removePermission(int $id): bool;

    public function allPermissions(array $query): object;

    public function commonPermissions(): array;
}