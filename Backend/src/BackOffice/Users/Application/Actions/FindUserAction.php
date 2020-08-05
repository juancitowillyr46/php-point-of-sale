<?php


namespace App\BackOffice\Users\Application\Actions;


use Psr\Http\Message\ResponseInterface as Response;

class FindUserAction extends UsersAction
{

    protected function action(): Response
    {
        $uuid = $this->resolveArg('uuid');
        $success = $this->service->find($uuid);
        return $this->respondWithData($success);
    }
}