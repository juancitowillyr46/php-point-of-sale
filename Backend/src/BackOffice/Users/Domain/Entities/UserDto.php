<?php
namespace App\BackOffice\Users\Domain\Entities;

class UserDto
{
    public string $uuid;
    public string $email;
    public string $username;
    public string $typeUser;
    public string $active;
    public string $createdAt;
}