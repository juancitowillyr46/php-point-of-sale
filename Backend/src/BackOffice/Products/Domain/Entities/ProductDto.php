<?php
namespace App\BackOffice\Products\Domain\Entities;

class ProductDto
{
    public string $id;
    public string $description;
    public string $name;
    public bool $active;
    public string $activeName;
    public string $createdAt;

    public string $categoryName;
    public string $categoryId;

    public string $measureUnitName;
    public string $measureUnitId;

    public string $providerName;
    public string $providerId;

    public string $code;
}