<?php
namespace App\BackOffice\Roles\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class RoleCommonAction  extends RoleAction
{
    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->roleFindAllService->executeCommon());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}