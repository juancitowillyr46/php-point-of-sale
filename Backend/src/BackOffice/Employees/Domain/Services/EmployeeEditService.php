<?php
namespace App\BackOffice\Employees\Domain\Services;

use App\BackOffice\UsersType\Domain\Entities\UserTypeModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class EmployeeEditService extends EmployeeService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findEmployee = $this->findResourceByUuid(new UserTypeModel(), $uuid);

            $this->EmployeeEntity->payload($bodyParsed);
            $success = $this->EmployeeRepository->editEmployee($findEmployee, ((array) $this->EmployeeEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->EmployeeEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}