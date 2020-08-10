<?php
namespace App\BackOffice\UsersType\Domain\Services;

use App\BackOffice\Users\Domain\Entities\UserDto;
use App\BackOffice\UsersType\Domain\Entities\UserType;
use App\BackOffice\UsersType\Domain\Entities\UserTypeDto;
use App\BackOffice\UsersType\Domain\Entities\UserTypeMapper;
use App\BackOffice\UsersType\Infrastructure\Persistence\UserTypeRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class UserTypeService extends BaseService
{
    public UserTypeMapper $mapper;
    public UserType $userType;
    public UserTypeRepository $repository;

    public function __construct(UserTypeMapper $mapper, UserTypeRepository $repository, UserType $userType)
    {
        $this->mapper = $mapper;
        $this->userType = $userType;
        $this->repository = $repository;
        $this->setRepository($repository);
    }

    public function payLoad(object $request): array
    {
        try {
            $userType = $this->userType;
            if($request->uuid != "") {
                $userType->setUuid($request->uuid);
            } else {
                $userType->setUuid(UuidGenerate::uuid1());
            }
            $userType->setName($request->name);
            $userType->setDescription($request->description);
            $userType->setActive($request->active);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return (array) $userType;
    }

    public function findToDto(string $uuid) {
        return $this->mapper->autoMapper->map($this->find($uuid), UserTypeDto::class);
    }

}