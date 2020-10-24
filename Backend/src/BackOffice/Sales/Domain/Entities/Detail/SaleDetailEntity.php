<?php
namespace App\BackOffice\Sales\Domain\Entities\Detail;

use App\BackOffice\Sales\Domain\Exceptions\SaleDetailActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class SaleDetailEntity extends Audit
{
    public int $sale_id;
    public int $product_id;
    public int $quantity;
    public float $price;
    public float $subtotal;

    /**
     * @return int
     */
    public function getSaleId(): int
    {
        return $this->sale_id;
    }

    /**
     * @param int $sale_id
     */
    public function setSaleId(int $sale_id): void
    {
        $this->sale_id = $sale_id;
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
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * @param float $subtotal
     */
    public function setSubtotal(float $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    public function validateBodyParsed(object $formData): void {

        try {

            $validate = new SaleDetailActionRequestSchema();
            $validate->getMessages((array) $formData);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}