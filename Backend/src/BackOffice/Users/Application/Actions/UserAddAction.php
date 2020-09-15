<?php
namespace App\BackOffice\Users\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class UserAddAction extends UsersAction
{
    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->userAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}