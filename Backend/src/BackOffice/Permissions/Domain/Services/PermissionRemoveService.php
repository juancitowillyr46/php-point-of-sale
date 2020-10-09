<?php
namespace App\BackOffice\Permissions\Domain\Services;

use App\BackOffice\Permissions\Domain\Entities\PermissionModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class PermissionRemoveService extends PermissionService
{
    public function executeArg(string $uuid): object {
        try {

            $findPermission = $this->findResourceByUuid(new PermissionModel(), $uuid);
            $success = $this->permissionRepository->removePermission((int) $findPermission);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->permissionEntity->setUuid($uuid);
            return $this->permissionEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}