<?php
namespace App\BackOffice\Users\Infrastructure\Persistence;

use App\BackOffice\Users\Domain\Entities\User;
use App\BackOffice\Users\Domain\Repository\UserRepositoryInterface;
use App\Shared\Utility\SecurityPassword;
use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid as UuidGenerate;

class UserRepository implements UserRepositoryInterface
{

    private array $users = [];

    public function add(User $user): bool
    {
        $users[] = $user;
        return true;
    }

    public function edit(int $id, User $user): bool
    {
        // TODO: Implement edit() method.
        return true;
    }

    public function find(int $id): object
    {
        $userd = new User();
        $userd->setId(0);
        $userd->setTypeUserId(0);
        $userd->setUuid(UuidGenerate::uuid1());
        $userd->setUsername('juan.rodas@gmail.com');
        $userd->setPassword('12345678');
        $userd->setEmail('jrodas@gmail.com');
        $userd->setTypeUser('65465465465');
        $userd->setCreatedAt(Chronos::now()->format("Y-mm-dd hh:mm:ss"));
        $userd->setCreatedBy('ADMIN');
        $userd->setUpdatedAt('');
        $userd->setUpdatedBy('');
        $userd->setDeletedAt('');
        $userd->setDeletedBy('');
        $userd->setActive(true);
        return $userd;
    }

    public function remove(): bool
    {
        return true;
    }

    public function all(): array
    {
        return $this->users;
    }

    public function findByUuid(string $uuid): object
    {

        return $this->users[0];
    }
}