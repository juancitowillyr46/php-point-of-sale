<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\UserDto;
use App\BackOffice\Users\Domain\Entities\UserInfoDto;
use App\BackOffice\Users\Domain\Entities\UserModel;
use Exception;

class UserFindService extends UserService
{
    public function executeArg(string $uuid): object {

        try {

            $findUserId = $this->findResourceByUuid(new UserModel(), $uuid);
            $findUser = $this->userRepository->findUser($findUserId);
            return $this->userMapper->autoMapper->map($findUser, UserDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getInfo(string $uuid): object {
        try {

            $findUserId = $this->findResourceByUuid(new UserModel(), $uuid);
            $findUser = $this->userRepository->findUser($findUserId);
            return $this->userMapper->autoMapper->map($findUser, UserInfoDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}