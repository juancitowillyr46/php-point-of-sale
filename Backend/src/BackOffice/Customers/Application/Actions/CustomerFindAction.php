<?php
namespace App\BackOffice\Customers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class CustomerFindAction extends CustomersAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->customerFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}