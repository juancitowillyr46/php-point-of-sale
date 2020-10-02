<?php
namespace App\Shared\Utility;

use DateTime;
use Exception;
use Firebase\JWT\JWT;

class JwtCustom
{
    private string $exp = "+20 minutes";
    private string $secretKey = '12345678';

    public function geToken($userData): string
    {

        try {

            $now = new DateTime();
            $future = new DateTime($this->exp);

            $payload = array(
                'iat' => $now->getTimeStamp(),
                'exp' => $future->getTimeStamp(),
                'data' => $userData
            );

            return JWT::encode($payload, $this->secretKey);

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function decodeToken(string $jwt): object
    {
        return JWT::decode($jwt, $this->secretKey, array('HS256'));
    }
}