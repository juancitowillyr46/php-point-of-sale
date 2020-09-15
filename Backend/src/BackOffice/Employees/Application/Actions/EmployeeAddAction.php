<?php
namespace App\BackOffice\Employees\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class EmployeeAddAction extends EmployeesAction
{

    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->providerAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}