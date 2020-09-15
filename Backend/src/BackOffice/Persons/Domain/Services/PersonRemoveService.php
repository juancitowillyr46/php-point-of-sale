<?php
namespace App\BackOffice\Persons\Domain\Services;

use App\BackOffice\Persons\Domain\Entities\PersonModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class PersonRemoveService extends PersonService
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new PersonModel(), $uuid);
            $success = $this->personRepository->removePerson((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->personEntity->setUuid($uuid);
            return $this->personEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}