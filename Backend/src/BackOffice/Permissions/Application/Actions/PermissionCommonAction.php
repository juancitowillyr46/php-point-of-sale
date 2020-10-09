<?php
namespace App\BackOffice\Permissions\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PermissionCommonAction extends PermissionAction
{
    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->permissionFindAllService->executeCommon());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}