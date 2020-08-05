<?php
namespace App\Shared\Utility;

class SecurityPassword
{
    public static function encryptPassword($password): String {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hash): Bool {
        return password_verify($password, $hash);
    }
}