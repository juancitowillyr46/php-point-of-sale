<?php
namespace App\BackOffice\PurchasesDetail\Domain\Entities;

use App\Shared\Domain\Entities\Audit;

class PurchaseDetail extends Audit
{
    public int $buy_id;
    public int $product_id;
    public float $price;
    public int $quantity;

    /**
     * @return int
     */
    public function getBuyId(): int
    {
        return $this->buy_id;
    }

    /**
     * @param int $buy_id
     */
    public function setBuyId(int $buy_id): void
    {
        $this->buy_id = $buy_id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }


}