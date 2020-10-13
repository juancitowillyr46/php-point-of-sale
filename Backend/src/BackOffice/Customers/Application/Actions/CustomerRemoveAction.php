<?php
namespace App\BackOffice\Customers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class CustomerRemoveAction extends CustomersAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->customerRemoveService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}