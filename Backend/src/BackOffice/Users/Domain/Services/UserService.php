<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\User;
use App\BackOffice\Users\Domain\Entities\UserDto;
use App\BackOffice\Users\Domain\Entities\UserMapper;
use App\BackOffice\Users\Infrastructure\Persistence\UserRepository;
use App\BackOffice\UsersType\Domain\Services\UserTypeService;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\Commands\FindActionException;
use App\Shared\Utility\SecurityPassword;


class UserService extends BaseService
{
    public UserMapper $mapper;
    public User $user;
    public UserTypeService $userTypeService;

    public function __construct(UserMapper $mapper, UserRepository $userRepository, User $user, UserTypeService $userTypeService)
    {
        $this->mapper = $mapper;
        $this->user = $user;
        $this->userTypeService = $userTypeService;
        $this->setRepository($userRepository);
    }

    public function payLoad(object $request): array
    {
        $user = $this->user;
        $user->setUsername($request->username);
        $user->setPassword(SecurityPassword::encryptPassword($request->password));
        $user->setEmail($request->email);
        $user->setUserTypeUuid($request->userTypeUuid);

        try {

            $findUserType = $this->userTypeService->find($request->userTypeUuid);
            $user->setUserTypeId($findUserType['id']);

        } catch (FindActionException $e) {
            throw new FindActionException();
        }

        /* Ubicar el id del typeUserUuid */
        return (array) $user;
    }

    public function findToDto(string $uuid) {
        return $this->mapper->autoMapper->map($this->find($uuid), UserDto::class);
    }

}