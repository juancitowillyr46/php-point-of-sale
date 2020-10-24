<?php
namespace App\BackOffice\Sales\Domain\Entities;

use App\BackOffice\Sales\Domain\Exceptions\SaleActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class SaleEntity extends Audit
{
    public int $customer_id;
    public int $document_type_id;
    public string $document_number;
    public string $date;
    public float $total;
    public string $note;
    public float $tax;

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return int
     */
    public function getDocumentTypeId(): int
    {
        return $this->document_type_id;
    }

    /**
     * @param int $document_type_id
     */
    public function setDocumentTypeId(int $document_type_id): void
    {
        $this->document_type_id = $document_type_id;
    }

    /**
     * @return string
     */
    public function getDocumentNumber(): string
    {
        return $this->document_number;
    }

    /**
     * @param string $document_number
     */
    public function setDocumentNumber(string $document_number): void
    {
        $this->document_number = $document_number;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax(float $tax): void
    {
        $this->tax = $tax;
    }

    public function validateBodyParsed(object $formData): void {

        try {

            $validate = new SaleActionRequestSchema();
            $validate->getMessages((array) $formData);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}