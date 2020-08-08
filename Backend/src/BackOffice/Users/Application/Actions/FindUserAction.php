<?php
namespace App\BackOffice\Users\Application\Actions;

use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class FindUserAction extends UsersAction
{

    protected function action(): Response
    {
        try {

            $uuid = $this->resolveArg('uuid');
            $success = $this->service->findToDto($uuid);
            return $this->respondWithData($success);

        } catch (Exception $e) {

            $error = new ActionError(ActionError::BAD_REQUEST, $e->getMessage());
            $payLoad = new ActionPayload(ActionPayload::STATUS_NOT_FOUND, null, $error);
            return $this->respond($payLoad);
        }

    }
}