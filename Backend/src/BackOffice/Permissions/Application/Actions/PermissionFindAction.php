<?php
namespace App\BackOffice\Permissions\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PermissionFindAction extends PermissionAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->permissionFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}