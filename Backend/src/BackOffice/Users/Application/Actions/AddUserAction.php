<?php
namespace App\BackOffice\Users\Application\Actions;

use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class AddUserAction extends UsersAction
{

    protected function action(): Response
    {
        /* Process Logic */
        try {

            $requestData = $this->getFormData();

            /* Validation Schema Request */
            $validatePayload = $this->validatePayload($requestData);

            /* Set Data */
            $payLoad = $this->service->payLoad($requestData);

            /* Service */
            $success = $this->service->add($payLoad);

            return ($validatePayload !== null)? $this->respond($validatePayload) : $this->respondWithData($success);

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