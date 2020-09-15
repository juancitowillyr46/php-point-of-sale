<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class UserAddService extends UserService
{
    public function execute(object $bodyParsed): object {
        try {

            $findUserType = $this->findResourceByUuidReturnIdRegister($bodyParsed->userTypeId);

            $this->userEntity->setUserTypeId((int) $findUserType);
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