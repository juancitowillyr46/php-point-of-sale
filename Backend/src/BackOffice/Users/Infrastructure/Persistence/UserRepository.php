<?php
namespace App\BackOffice\Users\Infrastructure\Persistence;

use App\BackOffice\Users\Domain\Entities\UserModel;
use App\Shared\Exception\Commands\DuplicateActionException;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class UserRepository extends BaseRepository
{
    public function __construct(UserModel $userModel)
    {
        $this->setModel($userModel);
    }

//    public function findDuplicateRegister(array $request) {
//
//        // Exist Email
//        $existEmail = $this->findByAttr('email', $request['email']);
//        if($existEmail) {
//            throw new DuplicateActionException('El correo electrónico existe');
//        }
//
//        $existUsername = $this->findByAttr('username', $request['username']);
//        if($existUsername) {
//            throw new DuplicateActionException('El nombre de usuario existe');
//        }
//
//    }
}