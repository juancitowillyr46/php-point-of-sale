<?php
namespace App\BackOffice\Providers\Domain\Entities;

class ProviderDto
{
    public string $id;
    public string $description;
    public string $name;
    public bool $active;
    public string $activeName;
    public string $createdAt;
    public string $ruc;
    public string $homePhoneNumber;
    public string $cellPhoneNumber;
    public string $address;
    public string $departmentId;
    public string $provinceId;
    public string $districtId;
}