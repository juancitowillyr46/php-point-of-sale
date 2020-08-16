<?php
namespace App\BackOffice\Purchases\Domain\Entities;

class PurchaseDto
{
    public string $uuid;
    public string $documentType;
    public string $numDocument;
    public string $serieDocument;
    public string $status;
    public string $date;
    public float $total;
    public string $employee;
    public string $createdAt;
    public string $active;
}