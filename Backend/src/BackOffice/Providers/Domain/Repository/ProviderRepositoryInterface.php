<?php
namespace App\BackOffice\Providers\Domain\Repository;

interface ProviderRepositoryInterface
{
    public function addProvider(array $Provider): bool;

    public function editProvider(int $id, array $userType): bool;

    public function findProvider(int $id): array;

    public function removeProvider(int $id): bool;

    public function allProviders(array $query): array;

    public function commonProviders(): array;
}