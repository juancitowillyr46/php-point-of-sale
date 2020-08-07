<?php
namespace App\BackOffice\Users\Infrastructure\Persistence;

use App\BackOffice\Users\Domain\Entities\UserModel;
use App\Shared\Infrastructure\Persistence\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(UserModel $userModel)
    {
        $this->setModel($userModel);
    }
}