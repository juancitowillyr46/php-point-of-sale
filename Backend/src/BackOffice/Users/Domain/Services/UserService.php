<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\UserEntity;
use App\BackOffice\Users\Domain\Entities\UserMapper;
use App\BackOffice\Users\Infrastructure\Persistence\UserRepository;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\Commands\DuplicateActionException;
use stdClass;

class UserService extends BaseService
{
    protected UserEntity $userEntity;
    protected UserRepository $userRepository;
    protected UserMapper $userMapper;

    public function __construct(UserRepository $userRepository, UserEntity $userEntity, UserMapper $userMapper)
    {
        $this->userRepository = $userRepository;
        $this->userEntity = $userEntity;
        $this->userMapper = $userMapper;
    }

    public function validateDuplicate(): void {

        $uuid = $this->userEntity->getUuid();
        $email = $this->userEntity->getEmail();
        $username = $this->userEntity->getUsername();

        $existEmail = $this->userRepository->findByAttr('email', $email, $uuid);
        if($existEmail) {
            throw new DuplicateActionException();
        }

        $existUsername = $this->userRepository->findByAttr('username', $username, $uuid);
        if($existUsername) {
            throw new DuplicateActionException();
        }
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