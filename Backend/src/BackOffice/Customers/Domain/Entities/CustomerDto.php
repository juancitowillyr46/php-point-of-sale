<?php
namespace App\BackOffice\Customers\Domain\Entities;

class CustomerDto
{
    public string $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $ruc;
    public string $businessName;
    public string $homePhoneNumber;
    public string $cellPhoneNumber;
    public string $documentNumber;
    public string $documentTypeName;
    public string $documentTypeId;
    public string $address;
    public string $departmentId;
    public string $provinceId;
    public string $districtId;
    public string $departmentName;
    public string $provinceName;
    public string $districtName;
    public bool $active;
    public string $activeName;
    public string $createdAt;

}