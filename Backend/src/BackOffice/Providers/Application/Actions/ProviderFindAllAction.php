<?php
namespace App\BackOffice\Providers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderFindAllAction extends ProvidersAction
{

    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            return $this->commandSuccess($this->providerFindAllService->executeCollectionPagination($query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}