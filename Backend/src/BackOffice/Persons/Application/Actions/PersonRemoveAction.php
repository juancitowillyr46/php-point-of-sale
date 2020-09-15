<?php
namespace App\BackOffice\Persons\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PersonRemoveAction extends PersonsAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->personRemoveService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}