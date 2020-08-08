<?php
namespace App\BackOffice\Users\Application\Actions;

use App\BackOffice\Users\Domain\Exceptions\UserActionValidateSchema;
use App\BackOffice\Users\Domain\Services\UserService;
use App\Shared\Action\Action;
use App\Shared\Action\ActionPayload;
use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\ValidationRequest;
use Psr\Log\LoggerInterface;

abstract class UsersAction extends Action
{
    public UserService $service;
    public ValidationRequest $validationRequest;

    public function __construct(LoggerInterface $logger, UserService $service, UserActionValidateSchema $validationRequest)
    {
        $this->validationRequest = $validationRequest;
        $this->service = $service;
        parent::__construct($logger, $validationRequest);
    }

}