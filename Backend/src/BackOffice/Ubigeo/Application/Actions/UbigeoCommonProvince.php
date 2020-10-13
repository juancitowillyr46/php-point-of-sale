<?php


namespace App\BackOffice\Ubigeo\Application\Actions;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UbigeoCommonProvince extends UbigeoAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('department_id');
            return $this->commandSuccess($this->ubigeoFindAllService->executeCommonProvinces($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}