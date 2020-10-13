<?php
namespace App\BackOffice\Providers\Application\Actions;

use App\BackOffice\Providers\Application\Actions\ProvidersAction;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderAddAction extends ProvidersAction
{

    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->providerAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}