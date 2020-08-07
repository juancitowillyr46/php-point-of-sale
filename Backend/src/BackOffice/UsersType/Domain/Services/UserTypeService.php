<?php
namespace App\BackOffice\UsersType\Domain\Services;

use App\BackOffice\Users\Domain\Entities\User;
use App\BackOffice\Users\Domain\Entities\UserDto;
use App\BackOffice\Users\Domain\Entities\UserMapper;
use App\BackOffice\Users\Infrastructure\Persistence\UserRepository;
use App\BackOffice\UsersType\Infrastructure\Persistence\UserTypeRepository;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Domain\Uuid;
use App\Shared\Exception\Commands\AddActionException;
use App\Shared\Exception\Commands\FindActionException;
use App\Shared\Utility\SecurityPassword;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Cake\Chronos\Chronos;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class UserTypeService extends BaseService
{

    public function __construct(UserTypeRepository $repository)
    {
        $this->setRepository($repository);
    }

    public function payLoad(object $request): array
    {
        return [];
    }
}