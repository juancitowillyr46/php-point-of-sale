<?php
namespace App\BackOffice\Purchases\Domain\Entities;

class PurchaseDto
{
    public string $id;
    public string $documentTypeName;
    public string $documentTypeId;
    public string $documentNumber;
    public string $date;
    public string $total;
    public string $providerId;
    public string $providerName;
    public string $createdAtName;
    public string $createdAt;
    public string $activeName;
    public bool $active;
    public string $note;
}