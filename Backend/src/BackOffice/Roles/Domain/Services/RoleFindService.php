<?php
namespace App\BackOffice\Roles\Domain\Services;

use App\BackOffice\Roles\Domain\Entities\RoleDto;
use App\BackOffice\Roles\Domain\Entities\RoleModel;
use Exception;

class RoleFindService extends RoleService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new RoleModel(), $uuid);
            $findRole = $this->roleRepository->findRole($findResourceId);
            return $this->roleMapper->autoMapper->map($findRole, RoleDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeGetRole(string $uuid) {
        try {

            $findUserId = $this->findResourceByUuid(new UserModel(), $uuid);
            $findUser = $this->userRepository->findUser($findUserId);
            return $this->userMapper->autoMapper->map($findUser, UserInfoDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}