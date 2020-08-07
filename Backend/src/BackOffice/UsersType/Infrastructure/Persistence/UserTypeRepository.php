<?php
namespace App\BackOffice\UsersType\Infrastructure\Persistence;

use App\BackOffice\UsersType\Domain\Entities\UserTypeModel;
use App\Shared\Infrastructure\Persistence\BaseRepository;

class UserTypeRepository  extends BaseRepository
{
    public function __construct(UserTypeModel $userTypeModel)
    {
        $this->setModel($userTypeModel);
    }
}