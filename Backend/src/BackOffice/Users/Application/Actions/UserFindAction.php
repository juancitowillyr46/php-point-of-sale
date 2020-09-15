<?php
namespace App\BackOffice\Users\Application\Actions;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserFindAction extends UsersAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->userFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}