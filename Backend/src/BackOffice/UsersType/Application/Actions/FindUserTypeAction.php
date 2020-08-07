<?php
namespace App\BackOffice\UsersType\Application\Actions;

use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class FindUserTypeAction extends UsersTypeAction
{

    protected function action(): Response
    {
        $uuid = $this->resolveArg('uuid');

        try {

            $success = $this->service->find($uuid);
            return $this->respondWithData($success);

        } catch (Exception $e) {

            $error = new ActionError(ActionError::BAD_REQUEST, $e->getMessage());
            $payLoad = new ActionPayload(ActionPayload::STATUS_NOT_FOUND, null, $error);
            return $this->respond($payLoad);
        }

    }
}