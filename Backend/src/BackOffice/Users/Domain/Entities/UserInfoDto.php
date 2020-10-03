<?php


namespace App\BackOffice\Users\Domain\Entities;


class UserInfoDto
{
    public string $fullname;
    public string $email;
    public string $role;
    public array $permissions;
}
