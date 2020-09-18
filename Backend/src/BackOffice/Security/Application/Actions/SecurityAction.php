<?php
namespace App\BackOffice\Security\Application\Actions;

use App\BackOffice\Security\Domain\Services\LoginService;
use App\BackOffice\Security\Domain\Services\RefreshTokenService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class SecurityAction extends Action
{
    public LoginService $loginService;
    public RefreshTokenService $refreshTokenService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        LoginService $loginService,
        RefreshTokenService $refreshTokenService
    )
    {
        $this->loginService = $loginService;
        $this->refreshTokenService = $refreshTokenService;
        parent::__construct($logger);
    }

}

