<?php
namespace App\BackOffice\Categories\Domain\Repository;

interface CategoryRepositoryInterface
{
    public function addCategory(array $category): bool;

    public function editCategory(int $id, array $userType): bool;

    public function findCategory(int $id): array;

    public function removeCategory(int $id): bool;

    public function allCategories(array $query): array;
}