<?php
namespace App\BackOffice\Providers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderRemoveAction extends ProvidersAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->providerRemoveService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}