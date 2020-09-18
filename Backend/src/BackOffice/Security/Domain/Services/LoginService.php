<?php
namespace App\BackOffice\Security\Domain\Services;

use App\BackOffice\Security\Domain\Entities\LoginDto;
use App\BackOffice\Security\Domain\Entities\LoginEntity;
use App\BackOffice\Security\Domain\Entities\LoginMapper;
use App\BackOffice\Security\Domain\Entities\TokenEntity;
use App\BackOffice\Security\Domain\Exceptions\PasswordIncorrectException;
use App\BackOffice\Security\Domain\Exceptions\UserBlockedException;
use App\BackOffice\Security\Domain\Exceptions\UserNotExistException;
use App\BackOffice\Security\Infrastructure\Persistence\SecurityRepository;
use App\Shared\Utility\JwtCustom;
use App\Shared\Utility\SecurityPassword;
use Exception;

class LoginService extends Securityservice
{

    private BlockedUserService $blockedUserService;

    public function __construct(SecurityRepository $securityRepository, LoginEntity $loginEntity, LoginMapper $loginMapper, BlockedUserService $blockedUserService)
    {
        $this->blockedUserService = $blockedUserService;
        parent::__construct($securityRepository, $loginEntity, $loginMapper);
    }

    public function execute(object $bodyParsed): object {
        try {

            $this->loginEntity->payload($bodyParsed);

            $login = $this->securityRepository->searchUserByUsername($this->loginEntity->getUsername());
            if(is_null($login)){
                throw new UserNotExistException();
            }

            $this->blockedUserService->executeBoolean($bodyParsed);

            $verifyPassword = SecurityPassword::verifyPassword($this->loginEntity->getPassword(), $login->password);
            if(!$verifyPassword){
                throw new PasswordIncorrectException();
            }

            $loginDto = new LoginDto();
            $loginDto->setId($login->uuid);
            $loginDto->setEmail($login->email);
            $loginDto->setUsername($login->username);

            $jwt = new JwtCustom();
            $token = $jwt->geToken($loginDto);

            $tokenEntity = new TokenEntity();
            $tokenEntity->setToken($token);

            return $tokenEntity;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}