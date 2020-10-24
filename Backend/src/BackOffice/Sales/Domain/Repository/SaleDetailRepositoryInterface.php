<?php
namespace App\BackOffice\Sales\Domain\Repository;


interface SaleDetailRepositoryInterface
{
    public function addSaleDetail(array $sale): bool;

    public function editSaleDetail(int $id, array $sale): bool;

    public function findSaleDetail(int $id): array;

    public function removeSaleDetail(int $id): bool;

    public function allPurchasesDetail(array $query): object;
}