<?php
namespace App\BackOffice\PurchasesDetail\Domain\Entities;

use App\BackOffice\PurchasesDetail\Domain\Exceptions\PurchaseDetailValidateSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class PurchaseDetailEntity extends Audit
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

    public function payload(object $formData): void {

        try {

            $validate = new PurchaseDetailValidateSchema();
            $validate->getMessages((array) $formData);

            $this->identifiedResource($formData);

            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}