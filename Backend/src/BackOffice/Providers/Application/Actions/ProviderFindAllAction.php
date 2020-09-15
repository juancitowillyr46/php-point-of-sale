<?php
namespace App\BackOffice\Categories\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderFindAllAction extends CategoriesAction
{

    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            return $this->commandSuccess($this->providerFindAllService->executeCollection($query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}