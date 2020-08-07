<?php
namespace App\BackOffice\UsersType\Application\Actions;

use App\BackOffice\UsersType\Domain\Exceptions\AddUserTypeActionValidation;
use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class AddUserTypeAction extends UsersTypeAction
{

    protected function action(): Response
    {
        /* Process Logic */
        try {

            $requestData = $this->getFormData();

            /* Validation Schema Request */
            $validateRequest = new AddUserTypeActionValidation();
            $validateRequest->setData((array) $requestData);
            $payload = $validateRequest->validateRequest($validateRequest->getMessages());

            $success = $this->service->add($requestData);
            return ($payload !== null)? $this->respond($payload) : $this->respondWithData($success);

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