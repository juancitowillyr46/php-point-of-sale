<?php
namespace App\BackOffice\UsersType\Application\Actions;

use Psr\Http\Message\ResponseInterface as Response;

class RemoveUserTypeAction extends UsersTypeAction
{
    protected function action(): Response
    {
        return $this->actionCommand($this->service);
    }
}