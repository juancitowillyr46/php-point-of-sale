<?php
namespace App\BackOffice\Users\Application\Actions;

use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class RemoveUserAction extends UsersAction
{

    protected function action(): Response
    {
        /* Process Logic */
        try {

            $uuid = $this->resolveArg('uuid');

            /* Service */
            $success = $this->service->remove($uuid);

            return $this->respondWithData($success);

        } catch (Exception $e) {

            $message = $e->getMessage();

            if($e->getCode() === 1500){
                $message = json_decode($e->getMessage(), JSON_PRETTY_PRINT);
            }

            $error = new ActionError(ActionError::BAD_REQUEST, $message);
            $payLoad = new ActionPayload(ActionPayload::STATUS_NOT_FOUND, null, $error);
            return $this->respond($payLoad);

        }
    }
}