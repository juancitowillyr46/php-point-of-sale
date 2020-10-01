<?php
namespace App\BackOffice\Roles\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class RoleRemoveAction extends RoleAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->roleRemoveService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}