<?php
namespace App\BackOffice\PurchasesDetail\Domain\Repository;

interface PurchaseDetailRepositoryInterface
{
    public function addPurchaseDetail(array $purchase): bool;

    public function editPurchaseDetail(int $id, array $purchase): bool;

    public function findPurchaseDetail(int $id): array;

    public function removePurchaseDetail(int $id): bool;

    public function allPurchasesDetails(int $purchaseId, array $query): array;
}