<?php
namespace App\BackOffice\Categories\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderFindAction extends CategoriesAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->providerFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}