<?php
namespace App\BackOffice\Roles\Domain\Services;

use App\BackOffice\Roles\Domain\Entities\RoleModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class RoleEditService extends RoleService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findRole = $this->findResourceByUuid(new RoleModel(), $uuid);

            $this->roleEntity->payload($bodyParsed);
            $success = $this->roleRepository->editRole($findRole, ((array) $this->roleEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->roleEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}