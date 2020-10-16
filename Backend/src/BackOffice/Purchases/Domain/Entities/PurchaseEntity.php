<?php
namespace App\BackOffice\Purchases\Domain\Entities;

use App\BackOffice\Purchases\Domain\Exceptions\PurchaseActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class PurchaseEntity extends Audit
{
    public int $provider_id;
    public int $document_type_id;
    public string $document_number;
    public string $date;
    public float $total;
    public float $tax;
    public string $note;

    /**
     * @return int
     */
    public function getProviderId(): int
    {
        return $this->provider_id;
    }

    /**
     * @param int $provider_id
     */
    public function setProviderId(int $provider_id): void
    {
        $this->provider_id = $provider_id;
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

    public function validateBodyParsed(object $formData): void {

        try {

            $validate = new PurchaseActionRequestSchema();
            $validate->getMessages((array) $formData);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}