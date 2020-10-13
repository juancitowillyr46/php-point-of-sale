<?php
namespace App\BackOffice\Customers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class CustomerFindAllAction extends CustomersAction
{

    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            return $this->commandSuccess($this->customerFindAllService->executeCollectionPagination($query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}