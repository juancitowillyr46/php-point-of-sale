<?php
namespace App\BackOffice\Employees\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class EmployeeFindAction extends EmployeesAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->providerFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}