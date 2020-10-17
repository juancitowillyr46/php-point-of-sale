<?php
namespace App\BackOffice\Purchases\Domain\Entities\Detail;

class PurchaseDetailDto
{
    public string $id;
    public string $purchaseId;
    public string $productId;
    public string $productName;
    public int $quantity;
    public string $price;
    public string $subtotal;
    public bool $active;
    public bool $activeName;
    public string $createdAt;
}