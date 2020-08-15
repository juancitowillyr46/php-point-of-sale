<?php
namespace App\BackOffice\Users\Application\Actions;

use App\BackOffice\Users\Domain\Exceptions\UserActionRequestSchema;
use App\BackOffice\Users\Domain\Services\UserService;
use Psr\Log\LoggerInterface;

class UsersAction
{
    public UserActionRequestSchema $validateSchema;
    public UserService $service;
    public LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, UserActionRequestSchema $validateSchema, UserService $service)
    {
        $this->validateSchema = $validateSchema;
        $this->service = $service;
        $this->logger = $logger;
    }
}

