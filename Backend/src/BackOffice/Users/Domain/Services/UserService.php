<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\User;
use App\BackOffice\Users\Domain\Entities\UserDto;
use App\BackOffice\Users\Domain\Entities\UserMapper;
use App\BackOffice\Users\Infrastructure\Persistence\UserRepository;
use App\BackOffice\UsersType\Domain\Services\UserTypeService;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\Commands\DuplicateActionException;
use App\Shared\Utility\SecurityPassword;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class UserService extends BaseService
{
    public UserMapper $mapper;
    public User $user;
    public UserTypeService $userTypeService;
    public UserRepository $userRepository;

    public function __construct(UserMapper $mapper, UserRepository $userRepository, User $user, UserTypeService $userTypeService)
    {
        $this->mapper = $mapper;
        $this->user = $user;
        $this->userTypeService = $userTypeService;
        $this->userRepository = $userRepository;
        $this->setRepository($userRepository);
    }

    public function payLoad(object $request): array
    {

        try {

            $this->validateDuplicate((array) $request);

            $user = $this->user;

            if($request->uuid != "") {
                $user->setUuid($request->uuid);
            } else {
                $user->setUuid(UuidGenerate::uuid1());
            }

            $user->setUsername($request->username);
            $user->setPassword(SecurityPassword::encryptPassword($request->password));
            $user->setEmail($request->email);
            $user->setUserTypeUuid($request->userTypeUuid);
            $user->setActive($request->active);
            $findUserType = $this->userTypeService->find($request->userTypeUuid);

            $user->setUserTypeId($findUserType['id']);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        /* Ubicar el id del typeUserUuid */
        return (array) $user;
    }

    public function findToDto(string $uuid) {
        return $this->mapper->autoMapper->map($this->find($uuid), UserDto::class);
    }

    public function validateDuplicate(array $request): void {

        $existEmail = $this->userRepository->findByAttr('email', $request['email'], $request['uuid']);
        if($existEmail) {
            throw new DuplicateActionException();
        }

        $existUsername = $this->userRepository->findByAttr('username', $request['username'], $request['uuid']);
        if($existUsername) {
            throw new DuplicateActionException();
        }

    }

}