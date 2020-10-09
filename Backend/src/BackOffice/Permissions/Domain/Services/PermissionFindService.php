<?php
namespace App\BackOffice\Permissions\Domain\Services;

use App\BackOffice\Permissions\Domain\Entities\PermissionDto;
use App\BackOffice\Permissions\Domain\Entities\PermissionModel;
use Exception;

class PermissionFindService extends PermissionService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new PermissionModel(), $uuid);
            $findPermission = $this->permissionRepository->findPermission($findResourceId);
            return $this->permissionMapper->autoMapper->map($findPermission, PermissionDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeGetPermission(string $uuid) {
        try {

            $findUserId = $this->findResourceByUuid(new UserModel(), $uuid);
            $findUser = $this->userRepository->findUser($findUserId);
            return $this->userMapper->autoMapper->map($findUser, UserInfoDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}