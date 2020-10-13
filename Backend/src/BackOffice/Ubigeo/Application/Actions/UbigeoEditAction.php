<?php
namespace App\BackOffice\Ubigeo\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UbigeoEditAction extends UbigeoAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->ubigeoEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}