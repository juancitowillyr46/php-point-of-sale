<?php
namespace App\BackOffice\Ubigeo\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UbigeoFindAllAction extends UbigeoAction
{

    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            return $this->commandSuccess($this->ubigeoFindAllService->executeCollectionPagination($query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}