<?php
namespace App\BackOffice\Permissions\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PermissionAddAction extends PermissionAction
{

    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->permissionAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}