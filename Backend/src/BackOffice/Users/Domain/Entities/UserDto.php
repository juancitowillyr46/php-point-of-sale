<?php
namespace App\BackOffice\Users\Domain\Entities;

class UserDto
{
    public string $uuid;
    public string $email;
    public string $username;
    public string $typeId;
    public string $active;
    public string $createdAt;
}