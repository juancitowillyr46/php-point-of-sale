<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\UserModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class UserRemoveService extends UserService
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new UserModel(), $uuid);
            $success = $this->userRepository->removeUser((int) $findUser);

            if(!$success) {
                throw new RemoveActionException();
            }
            $this->userEntity->setUuid($uuid);
            return $this->userEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}