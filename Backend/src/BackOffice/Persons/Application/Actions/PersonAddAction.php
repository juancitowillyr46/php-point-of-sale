<?php
namespace App\BackOffice\Persons\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PersonAddAction extends PersonsAction
{
    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->personAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}