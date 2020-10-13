<?php


namespace App\BackOffice\Ubigeo\Application\Actions;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UbigeoCommonDepartment extends UbigeoAction
{
    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->ubigeoFindAllService->executeCommonDepartments());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}