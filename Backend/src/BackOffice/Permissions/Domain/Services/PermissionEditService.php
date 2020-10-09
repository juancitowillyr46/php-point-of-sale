<?php
namespace App\BackOffice\Permissions\Domain\Services;

use App\BackOffice\Permissions\Domain\Entities\PermissionModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class PermissionEditService extends PermissionService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findPermission = $this->findResourceByUuid(new PermissionModel(), $uuid);

            if($bodyParsed->parentId == "0" || $bodyParsed->parentId == 0 || $bodyParsed->parentId == ""){
                $findParent = 0;
            } else {
                $findParent = $this->findResourceByUuid(new PermissionModel(), $bodyParsed->parentId);
            }

            $this->permissionEntity->setParentId($findParent);

            $this->permissionEntity->payload($bodyParsed);
            $success = $this->permissionRepository->editPermission($findPermission, ((array) $this->permissionEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->permissionEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}