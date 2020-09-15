<?php
namespace App\BackOffice\Employees\Domain\Services;

use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class EmployeeAddService extends EmployeeService
{

    public function execute(object $bodyParsed): object
    {
        try {

            $this->EmployeeEntity->payload($bodyParsed);
            $success = $this->EmployeeRepository->addEmployee(((array) $this->EmployeeEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->EmployeeEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}