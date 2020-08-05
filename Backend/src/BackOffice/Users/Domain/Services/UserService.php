<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\User;
use App\BackOffice\Users\Infrastructure\Persistence\UserRepository;
use App\Shared\Domain\Uuid;
use App\Shared\Utility\SecurityPassword;
use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid as UuidGenerate;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class UserService
{
    public UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add(object $request): Uuid {

        // Get Request
        $user = new User();
        $user->setId(0);
        $user->setTypeUserId(0);
        $user->setUuid(UuidGenerate::uuid1());
        $user->setUsername($request->username);
        $user->setPassword(SecurityPassword::encryptPassword($request->password));
        $user->setEmail($request->email);
        $user->setTypeUser($request->typeUser);
        $user->setCreatedAt(Chronos::now()->format("Y-mm-dd hh:mm:ss"));
        $user->setCreatedBy('ADMIN');
        $user->setUpdatedAt('');
        $user->setUpdatedBy('');
        $user->setDeletedAt('');
        $user->setDeletedBy('');
        $user->setActive($request->active);

        // Get Uuid
        $uid = new Uuid();
        $uid->setUuid($user->getUuid());

        // Get Repository
        $this->repository->add($user);
        return $uid;
    }

    public function find(string $uuid): object
    {
        $userx = $this->repository->find(1);

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        return json_decode($serializer->serialize($userx,'json'));
    }
}