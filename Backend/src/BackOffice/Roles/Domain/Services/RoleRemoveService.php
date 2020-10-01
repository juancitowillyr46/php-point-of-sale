<?php
namespace App\BackOffice\Roles\Domain\Services;

use App\BackOffice\Roles\Domain\Entities\RoleModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class RoleRemoveService extends RoleService
{
    public function executeArg(string $uuid): object {
        try {

            $findRole = $this->findResourceByUuid(new RoleModel(), $uuid);
            $success = $this->roleRepository->removeRole((int) $findRole);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->roleEntity->setUuid($uuid);
            return $this->roleEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}