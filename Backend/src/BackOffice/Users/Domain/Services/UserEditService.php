<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\Roles\Domain\Entities\RoleModel;
use App\BackOffice\Users\Domain\Entities\UserModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class UserEditService extends UserService
{
    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            // $findResourceUserType = $this->findResourceByUuid(new DataMasterModel(), $bodyParsed->userTypeId);



            $findUser = $this->findResourceByUuid(new UserModel(), $uuid);
            $findRole = $this->findResourceByUuid(new RoleModel(), $bodyParsed->roleId);
            //$this->userEntity->setUserTypeId($findUserType);
            $this->userEntity->setRoleId($findRole);
            $this->userEntity->payload($bodyParsed);
            $this->validateDuplicate();

            $success = $this->userRepository->editUser((int) $findUser, (array) $this->userEntity);
            if(!$success) {
                throw new EditActionException();
            }

            return $this->userEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}