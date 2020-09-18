<?php


namespace App\BackOffice\Security\Domain\Services;


use App\BackOffice\Security\Domain\Entities\LoginEntity;
use App\BackOffice\Security\Domain\Entities\LoginMapper;
use App\BackOffice\Security\Infrastructure\Persistence\SecurityRepository;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class SecurityService extends BaseService
{
    protected LoginEntity $loginEntity;
    protected SecurityRepository $securityRepository;
    protected LoginMapper $loginMapper;

    public function __construct(SecurityRepository $securityRepository, LoginEntity $loginEntity, LoginMapper $loginMapper)
    {
        $this->securityRepository = $securityRepository;
        $this->loginEntity = $loginEntity;
        $this->loginMapper = $loginMapper;
    }

    function execute(object $bodyParsed): object
    {
        return new stdClass();
    }

    function executeArg(string $uuid): object
    {
        return new stdClass();
    }

    function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object
    {
        return new stdClass();
    }

    function executeCollection(array $query): array
    {
        return [];
    }
}