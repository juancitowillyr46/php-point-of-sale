<?php
namespace App\BackOffice\Employees\Domain\Services;

use App\BackOffice\Employees\Domain\Entities\EmployeeDto;
use App\BackOffice\Employees\Domain\Entities\EmployeeModel;
use Exception;

class EmployeeFindService extends EmployeeService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new EmployeeModel(), $uuid);
            $findUser = $this->EmployeeRepository->findEmployee($findResourceId);
            return $this->EmployeeMapper->autoMapper->map($findUser, EmployeeDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}