<?php
namespace App\BackOffice\UsersType\Application\Actions;

use App\BackOffice\Users\Domain\Services\UserService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class UsersTypeAction extends Action
{
    public UsersTypeService $service;

    public function __construct(LoggerInterface $logger, UserService $service)
    {
        $this->service = $service;
        parent::__construct($logger);
    }

//    abstract public function validateRequest();
}