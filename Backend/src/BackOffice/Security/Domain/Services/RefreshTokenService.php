<?php
namespace App\BackOffice\Security\Domain\Services;

use App\BackOffice\Security\Domain\Entities\LoginDto;
use App\BackOffice\Security\Domain\Entities\TokenEntity;
use App\Shared\Utility\JwtCustom;
use Exception;

class RefreshTokenService extends SecurityService
{
    public function executeArg(string $token): object {
        try {
              if($token){

                  $jwt = new JwtCustom();
                  $jwt->decodeToken($token);

              }

        } catch (Exception $ex) {


            list($header, $payload, $signature) = explode(".", $token);

            $getHeader = base64_decode($header);
            $getPayLoad = json_decode(base64_decode($payload));
            $getPayLoad->data;

            $loginDto = new LoginDto();
            $loginDto->setId($getPayLoad->data->uuid);
            $loginDto->setEmail($getPayLoad->data->email);
            $loginDto->setUsername($getPayLoad->data->username);

            $jwt = new JwtCustom();
            $token = $jwt->geToken($loginDto);

            $tokenEntity = new TokenEntity();
            $tokenEntity->setToken($token);

            return $tokenEntity;
        }

        $tokenEntity = new TokenEntity();
        $tokenEntity->setToken($token);

        return $tokenEntity;
    }

}