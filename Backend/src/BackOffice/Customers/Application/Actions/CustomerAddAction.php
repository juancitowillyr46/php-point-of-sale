<?php
namespace App\BackOffice\Customers\Application\Actions;

use App\BackOffice\Customers\Application\Actions\CustomersAction;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class CustomerAddAction extends CustomersAction
{

    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->customerAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}