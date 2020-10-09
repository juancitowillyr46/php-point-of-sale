<?php
namespace App\BackOffice\Permissions\Domain\Services;

use App\BackOffice\Permissions\Domain\Entities\PermissionModel;
use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class PermissionAddService extends PermissionService
{

    public function execute(object $bodyParsed): object
    {
        try {

            if($bodyParsed->parentId == "0" || $bodyParsed->parentId == 0 || $bodyParsed->parentId == ""){
                $findParent = 0;
            } else {
                $findParent = $this->findResourceByUuid(new PermissionModel(), $bodyParsed->parentId);
            }

            $this->permissionEntity->setParentId($findParent);
            $this->permissionEntity->payload($bodyParsed);

            $success = $this->permissionRepository->addPermission(((array) $this->permissionEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->permissionEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}