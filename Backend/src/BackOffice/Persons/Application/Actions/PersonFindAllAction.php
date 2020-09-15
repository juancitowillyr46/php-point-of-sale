<?php
namespace App\BackOffice\Persons\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PersonFindAllAction extends PersonsAction
{

    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            return $this->commandSuccess($this->personFindAllService->executeCollection($query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}