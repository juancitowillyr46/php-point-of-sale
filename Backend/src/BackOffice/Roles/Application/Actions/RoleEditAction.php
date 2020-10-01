<?php
namespace App\BackOffice\Roles\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class RoleEditAction extends RoleAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->roleFindService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}