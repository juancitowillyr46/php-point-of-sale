<?php
namespace App\BackOffice\Purchases\Domain\Entities;

use App\BackOffice\Purchases\Domain\Exceptions\PurchaseActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class PurchaseEntity extends Audit
{
    public string $name;
    public int $document_type_id;
    public string $num_document;
    public string $serie_document;
    public int $provider_id;
    public int $status_id;
    public string $date;
    public float $total;
    public float $tax;
    public int $employee_id;
    public array $detail;

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->status_id;
    }

    /**
     * @param int $status_id
     */
    public function setStatusId(int $status_id): void
    {
        $this->status_id = $status_id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
    public function getNumDocument(): string
    {
        return $this->num_document;
    }

    /**
     * @param string $num_document
     */
    public function setNumDocument(string $num_document): void
    {
        $this->num_document = $num_document;
    }

    /**
     * @return string
     */
    public function getSerieDocument(): string
    {
        return $this->serie_document;
    }

    /**
     * @param string $serie_document
     */
    public function setSerieDocument(string $serie_document): void
    {
        $this->serie_document = $serie_document;
    }

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
     * @return int
     */
    public function getEmployeeId(): int
    {
        return $this->employee_id;
    }

    /**
     * @param int $employee_id
     */
    public function setEmployeeId(int $employee_id): void
    {
        $this->employee_id = $employee_id;
    }

    /**
     * @return array
     */
    public function getDetail(): array
    {
        return $this->detail;
    }

    /**
     * @param array $detail
     */
    public function setDetail(array $detail): void
    {
        $this->detail = $detail;
    }

    public function payload(object $formData): void {

        try {

            $validate = new PurchaseActionRequestSchema();
            $validate->getMessages((array) $formData);

            $this->identifiedResource($formData);

            $this->setNumDocument($formData->numDocument);
            $this->setSerieDocument($formData->serieDocument);
            $this->setDate($formData->date);
            $this->setTotal($formData->total);
            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}