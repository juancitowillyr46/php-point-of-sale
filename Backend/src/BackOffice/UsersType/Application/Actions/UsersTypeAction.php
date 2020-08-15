<?php
namespace App\BackOffice\UsersType\Application\Actions;

use App\BackOffice\UsersType\Domain\Exceptions\UserTypeActionRequestSchema;
use App\BackOffice\UsersType\Domain\Services\UserTypeService;
use Psr\Log\LoggerInterface;

class UsersTypeAction
{
    public UserTypeActionRequestSchema $validateSchema;
    public UserTypeService $service;
    public LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, UserTypeActionRequestSchema $validateSchema, UserTypeService $service)
    {
        $this->validateSchema = $validateSchema;
        $this->service = $service;
        $this->logger = $logger;
    }
}