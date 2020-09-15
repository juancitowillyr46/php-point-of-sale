<?php
namespace App\BackOffice\Users\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserEditAction extends UsersAction
{
    protected function action(): Response
    {
        try {

            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->userEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));

        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}