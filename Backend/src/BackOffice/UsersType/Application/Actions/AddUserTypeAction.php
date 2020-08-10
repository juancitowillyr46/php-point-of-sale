<?php
namespace App\BackOffice\UsersType\Application\Actions;

use App\BackOffice\UsersType\Domain\Exceptions\UserTypeActionValidateSchema;
use App\BackOffice\UsersType\Domain\Services\UserTypeService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class AddUserTypeAction extends UsersTypeAction
{

    public function __construct(LoggerInterface $logger, UserTypeService $service, UserTypeActionValidateSchema $schema)
    {
        parent::__construct($logger, $service, $schema);
    }

    protected function action(): Response
    {
        return $this->actionCommand($this->service);

        /* Process Logic */
//        try {
//
//            $requestData = $this->getFormData();
//
//            /* Validation Schema Request */
//            $validatePayload = $this->validatePayload($requestData);
//
//            /* Set Data */
//            $payLoad = $this->service->payLoad($requestData);
//
//            /* Service */
//            $success = $this->service->add($payLoad);
//
//            return ($validatePayload !== null)? $this->respond($validatePayload) : $this->respondWithData($success);
//
//        } catch (Exception $e) {
//
//            $message = $e->getMessage();
//
//            if($e->getCode() === 1500){
//                $message = json_decode($e->getMessage(), JSON_PRETTY_PRINT);
//            }
//
//            $error = new ActionError(ActionError::BAD_REQUEST, $message);
//            $payLoad = new ActionPayload(ActionPayload::STATUS_NOT_FOUND, null, $error);
//            return $this->respond($payLoad);
//
//        }

    }
}