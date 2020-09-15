<?php
namespace App\BackOffice\Employees\Domain\Repository;

interface EmployeeRepositoryInterface
{
    public function addEmployee(array $Employee): bool;

    public function editEmployee(int $id, array $userType): bool;

    public function findEmployee(int $id): array;

    public function removeEmployee(int $id): bool;

    public function allEmployees(array $query): array;
}