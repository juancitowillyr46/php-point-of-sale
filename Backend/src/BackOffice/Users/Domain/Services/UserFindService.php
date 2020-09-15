<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\UserDto;
use App\BackOffice\Users\Domain\Entities\UserModel;
use Exception;

class UserFindService extends UserService
{
    public function executeArg(string $uuid): object {

        try {

            $findUserId = $this->findResourceByUuid(new UserModel(), $uuid);
            $findUser = $this->userRepository->findUser($findUserId);
            $findUser['user_type'] = $this->findNameResourceByUIdRegister($findUser['user_type_id'], 'TABLE_TYPE_USER');
            return $this->userMapper->autoMapper->map($findUser, UserDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}