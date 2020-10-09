<?php
namespace App\BackOffice\Permissions\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PermissionEditAction extends PermissionAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->permissionEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}