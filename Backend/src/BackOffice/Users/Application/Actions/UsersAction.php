<?php
namespace App\BackOffice\Users\Application\Actions;

use App\BackOffice\Users\Domain\Services\UserService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class UsersAction extends Action
{

    public UserService $service;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }


}