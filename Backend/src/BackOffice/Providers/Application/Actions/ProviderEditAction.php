<?php
namespace App\BackOffice\Categories\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderEditAction extends CategoriesAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->providerFindService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}