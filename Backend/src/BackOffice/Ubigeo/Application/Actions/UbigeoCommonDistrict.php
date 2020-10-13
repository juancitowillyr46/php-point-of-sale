<?php


namespace App\BackOffice\Ubigeo\Application\Actions;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UbigeoCommonDistrict extends UbigeoAction
{
    protected function action(): Response
    {
        try {
            $department_id = $this->resolveArg('department_id');
            $province_id = $this->resolveArg('province_id');
            return $this->commandSuccess($this->ubigeoFindAllService->executeCommonDistricts($department_id, $province_id));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}