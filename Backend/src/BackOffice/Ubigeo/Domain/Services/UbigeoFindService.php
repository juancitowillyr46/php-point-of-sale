<?php
namespace App\BackOffice\Ubigeo\Domain\Services;

use App\BackOffice\Ubigeo\Domain\Entities\UbigeoDto;
use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use Exception;

class UbigeoFindService extends Ubigeoservice
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new UbigeoModel(), $uuid);
            $findUbigeo = $this->ubigeoRepository->findUbigeo($findResourceId);
            return $this->ubigeoMapper->autoMapper->map($findUbigeo, UbigeoDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeGetUbigeo(string $uuid) {
        try {

            $findUserId = $this->findResourceByUuid(new UserModel(), $uuid);
            $findUser = $this->userRepository->findUser($findUserId);
            return $this->userMapper->autoMapper->map($findUser, UserInfoDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}