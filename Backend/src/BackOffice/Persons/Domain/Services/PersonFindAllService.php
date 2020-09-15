<?php
namespace App\BackOffice\Persons\Domain\Services;

use App\BackOffice\Persons\Domain\Entities\PersonDto;
use Exception;

class PersonFindAllService extends PersonService
{

    public function executeCollection(array $query): array {
        try {

            $findPersonAll = $this->personRepository->allPersons($query);
            $listPerson = [];
            foreach ($findPersonAll as $person) {
                $listPerson[] = $this->personMapper->autoMapper->map($person, PersonDto::class);
            }
            return $listPerson;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}