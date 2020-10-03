<?php


namespace App\BackOffice\Roles\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class RoleSecurityAction extends RoleAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->roleFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}