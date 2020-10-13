<?php


namespace App\BackOffice\Ubigeo\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UbigeoSecurityAction extends UbigeoAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->ubigeoFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}