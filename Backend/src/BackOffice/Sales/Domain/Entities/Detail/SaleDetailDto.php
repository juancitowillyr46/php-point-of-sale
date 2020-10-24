<?php
namespace App\BackOffice\Sales\Domain\Entities\Detail;

class SaleDetailDto
{
    public string $id;
    public string $saleId;
    public string $productId;
    public string $productName;
    public int $quantity;
    public string $priceName;
    public float $price;
    public string $subtotalName;
    public float $subtotal;
    public bool $active;
    public bool $activeName;
    public string $createdAt;
}