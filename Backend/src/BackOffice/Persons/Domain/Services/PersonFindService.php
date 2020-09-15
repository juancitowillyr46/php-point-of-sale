<?php
namespace App\BackOffice\Persons\Domain\Services;

use App\BackOffice\Persons\Domain\Entities\PersonDto;
use App\BackOffice\Persons\Domain\Entities\PersonModel;
use Exception;

class PersonFindService extends PersonService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new PersonModel(), $uuid);
            $findUser = $this->personRepository->findPerson($findResourceId);
            return $this->personMapper->autoMapper->map($findUser, PersonDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}