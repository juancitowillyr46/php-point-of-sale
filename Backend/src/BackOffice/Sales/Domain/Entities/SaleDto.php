<?php
namespace App\BackOffice\Sales\Domain\Entities;

class SaleDto
{
    public string $id;
    public string $documentTypeName;
    public string $documentTypeId;
    public string $documentNumber;
    public string $date;
    public string $total;
    public string $customerId;
    public string $customerName;
    public string $createdAtName;
    public string $createdAt;
    public string $activeName;
    public bool $active;
    public string $note;
}