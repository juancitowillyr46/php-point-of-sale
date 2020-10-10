<?php
namespace App\BackOffice\DataMaster\Domain\Entities;

class DataMasterDto
{
    public string $id;
    public string $description;
    public string $name;
    public string $type;
    public int $idRegister;
    public bool $active;
    public string $activeName;
    public string $createdAt;
}