<?php
namespace App\Shared\Utility;

use DateTime;
use Firebase\JWT\JWT;

class JwtCustom
{
    private string $exp;
    private string $secretKey;

    public function __construct()
    {
//        $this->exp = $exp;
//        $this->secretKey = $secretKey;
    }

    public function geToken($payload): string
    {

        try {

            $future = new DateTime($this->exp);
            $payload['exp'] = $future->getTimeStamp();
            return JWT::encode($payload, $this->secretKey);

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

        }

    }

    public function decodeToken(string $jwt): object
    {
        return JWT::decode($jwt, $this->secretKey, array('HS256'));
    }
}