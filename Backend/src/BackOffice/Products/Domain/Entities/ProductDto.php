<?php
namespace App\BackOffice\Products\Domain\Entities;

class ProductDto
{
    public string $uuid;
    public string $description;
    public string $name;
    public string $active;
    public string $createdAt;
    public string $category;
    public string $measureUnit;
    public string $code;
}