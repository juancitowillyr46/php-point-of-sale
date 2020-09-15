<?php
namespace App\BackOffice\Persons\Domain\Entities;

class PersonDto
{
    public string $id;
    public string $firstName;
    public string $lastName;
    public string $homePhoneNumber;
    public string $cellPhoneNumber;
    public string $active;
    public string $createdAt;
}