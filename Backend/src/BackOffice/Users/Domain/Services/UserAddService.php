<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\Roles\Domain\Entities\RoleModel;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class UserAddService extends UserService
{
    public function execute(object $bodyParsed): object {
        try {

            $findRole = $this->findResourceByUuid(new RoleModel(), $bodyParsed->roleId);

            $this->userEntity->setRoleId($findRole);
            $this->userEntity->payload($bodyParsed);
            $this->validateDuplicate();

            $success = $this->userRepository->addUser((array) $this->userEntity);
            if(!$success) {
                throw new AddActionException();
            }
            return $this->userEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}