<?php
namespace App\BackOffice\PurchasesDetail\Domain\Entities;

class PurchaseDetailDto
{
    public string $id;
    public string $product;
    public string $buyUuid;
    public int $quantity;
    public float $price;
    public string $createdAt;
    public string $active;
}