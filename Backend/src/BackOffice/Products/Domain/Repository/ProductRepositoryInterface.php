<?php
namespace App\BackOffice\Products\Domain\Repository;

interface ProductRepositoryInterface
{
    public function addProduct(array $product): bool;

    public function editProduct(int $id, array $product): bool;

    public function findProduct(int $id): array;

    public function removeProduct(int $id): bool;

    public function allProduct(array $query): array;
}