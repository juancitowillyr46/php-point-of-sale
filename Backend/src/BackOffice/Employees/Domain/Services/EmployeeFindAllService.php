<?php
namespace App\BackOffice\Employees\Domain\Services;

use App\BackOffice\Employees\Domain\Entities\EmployeeDto;
use Exception;

class EmployeeFindAllService extends EmployeeService
{

    public function executeCollection(array $query): array {
        try {

            $findUserAll = $this->EmployeeRepository->allEmployees($query);
            $listUser = [];
            foreach ($findUserAll as $userType) {
                $listUser[] = $this->EmployeeMapper->autoMapper->map($userType, EmployeeDto::class);
            }
            return $listUser;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}