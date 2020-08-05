<?php
namespace App\BackOffice\Users\Application\Actions;

use App\BackOffice\Users\Domain\Exceptions\AddUserActionValidation;
use Psr\Http\Message\ResponseInterface as Response;

class AddUserAction extends UsersAction
{

    protected function action(): Response
    {
        $requestData = $this->getFormData();

        /* Validation Schema Request */
        $validateRequest = new AddUserActionValidation();
        $validateRequest->setData((array) $requestData);
        $payload = $validateRequest->validateRequest($validateRequest->getMessages());

        /* Procesa lógica */
        $success = $this->service->addUser($requestData);

        return ($payload !== null)? $this->respond($payload) : $this->respondWithData($success);

    }
}