<?php
namespace App\BackOffice\Customers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class CustomerEditAction extends CustomersAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->customerEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}