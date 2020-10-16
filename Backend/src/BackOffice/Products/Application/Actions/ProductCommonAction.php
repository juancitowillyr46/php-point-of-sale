<?php
namespace App\BackOffice\Products\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProductCommonAction extends ProductsAction
{
    protected function action(): Response
    {
        try {
            $providerId = $this->resolveArg('providerId');
            return $this->commandSuccess($this->productFindAllService->executeGetProductsByProvider($providerId));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}