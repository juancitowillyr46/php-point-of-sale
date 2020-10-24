<?php
namespace App\BackOffice\Sales\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class SaleEditAction extends SalesAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->saleEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}