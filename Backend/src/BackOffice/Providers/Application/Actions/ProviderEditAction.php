<?php
namespace App\BackOffice\Providers\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderEditAction extends ProvidersAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->providerEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}