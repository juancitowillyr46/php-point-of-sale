<?php
namespace App\BackOffice\Employees\Domain\Services;

use App\BackOffice\Employees\Domain\Entities\EmployeeModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class EmployeeRemoveService extends EmployeeService
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new EmployeeModel(), $uuid);
            $success = $this->EmployeeRepository->removeEmployee((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->EmployeeEntity->setUuid($uuid);
            return $this->EmployeeEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}