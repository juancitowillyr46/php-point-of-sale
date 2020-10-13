<?php
namespace App\BackOffice\Ubigeo\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UbigeoCommonAction extends UbigeoAction
{
    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->ubigeoFindAllService->executeCommon());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}