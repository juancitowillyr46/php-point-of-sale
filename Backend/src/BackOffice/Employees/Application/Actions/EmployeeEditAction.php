<?php
namespace App\BackOffice\Employees\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class EmployeeEditAction extends EmployeesAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->providerFindService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}