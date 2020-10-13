<?php
namespace App\BackOffice\Customers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class CustomerCommonAction extends CustomersAction
{
    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->customerFindAllService->executeCommon());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}