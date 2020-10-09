<?php
namespace App\BackOffice\Providers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderCommonAction extends ProvidersAction
{
    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->providerFindAllService->executeCommon());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}