<?php
namespace App\BackOffice\Sales\Domain\Repository;

interface SaleRepositoryInterface
{
    public function addSale(array $sale): bool;

    public function editSale(int $id, array $sale): bool;

    public function findSale(int $id): array;

    public function removeSale(int $id): bool;

    public function allPurchases(array $query): object;
}