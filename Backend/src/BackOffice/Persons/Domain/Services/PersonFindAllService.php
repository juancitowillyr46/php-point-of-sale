<?php
namespace App\BackOffice\Persons\Domain\Services;

use App\BackOffice\Persons\Domain\Entities\PersonDto;
use Exception;

class PersonFindAllService extends PersonService
{

    public function executeCollectionPagination(array $query): object {
        try {

            $findPersonAll = $this->personRepository->allPersons($query);
            $listPerson = [];
            foreach ($findPersonAll->registers as $person) {
                $listPerson[] = $this->personMapper->autoMapper->map($person, PersonDto::class);
            }
            $findPersonAll->registers = $listPerson;
            return $findPersonAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}