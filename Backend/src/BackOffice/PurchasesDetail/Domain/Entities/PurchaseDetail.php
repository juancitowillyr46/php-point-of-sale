<?php
namespace App\BackOffice\PurchasesDetail\Domain\Entities;

use App\Shared\Domain\Entities\Audit;

class PurchaseDetail extends Audit
{
    public int $buy_id;
    public int $product_id;
    public float $price;
    public int $quantity;
}