<?php
namespace App\BackOffice\Persons\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PersonFindAction extends PersonsAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->personFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}