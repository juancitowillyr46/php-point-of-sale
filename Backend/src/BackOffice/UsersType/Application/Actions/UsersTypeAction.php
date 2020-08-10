<?php
namespace App\BackOffice\UsersType\Application\Actions;

use App\BackOffice\UsersType\Domain\Exceptions\UserTypeActionValidateSchema;
use App\BackOffice\UsersType\Domain\Services\UserTypeService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class UsersTypeAction extends Action
{
    public UserTypeService $service;

    public function __construct(LoggerInterface $logger, UserTypeService $service, UserTypeActionValidateSchema $schema)
    {
        $this->service = $service;
        parent::__construct($logger, $schema);
    }
}