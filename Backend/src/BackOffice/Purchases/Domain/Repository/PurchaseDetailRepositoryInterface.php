<?php
namespace App\BackOffice\Purchases\Domain\Repository;


interface PurchaseDetailRepositoryInterface
{
    public function addPurchaseDetail(array $purchase): bool;

    public function editPurchaseDetail(int $id, array $purchase): bool;

    public function findPurchaseDetail(int $id): array;

    public function removePurchaseDetail(int $id): bool;

    public function allPurchasesDetail(array $query): object;
}