<?php
namespace App\BackOffice\Purchases\Domain\Repository;

interface PurchaseRepositoryInterface
{
    public function addPurchase(array $purchase): bool;

    public function editPurchase(int $id, array $purchase): bool;

    public function findPurchase(int $id): array;

    public function removePurchase(int $id): bool;

    public function allPurchases(array $query): array;
}