<?php
namespace App\BackOffice\Categories\Domain\Entities;

class CategoryDto
{
    public string $id;
    public string $description;
    public string $name;
    public bool $active;
    public string $activeName;
    public string $createdAt;
}