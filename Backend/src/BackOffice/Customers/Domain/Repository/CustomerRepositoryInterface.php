<?php
namespace App\BackOffice\Customers\Domain\Repository;

interface CustomerRepositoryInterface
{
    public function addCustomer(array $customer): bool;

    public function editCustomer(int $id, array $userType): bool;

    public function findCustomer(int $id): array;

    public function removeCustomer(int $id): bool;

    public function allCustomers(array $query): object;

    public function commonCustomers(): array;
}