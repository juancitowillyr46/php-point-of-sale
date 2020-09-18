<?php
namespace App\BackOffice\Security\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class RefreshTokenAction extends SecurityAction
{
    protected function action(): Response
    {
        try {

            $token = $this->resolveArg('token');
            return $this->commandSuccess($this->refreshTokenService->executeArg($token));

        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}