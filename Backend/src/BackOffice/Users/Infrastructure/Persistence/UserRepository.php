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

    public function getUser() {
        $model = $this->getModel()::all()->find(1);
        $f = $model->toArray();
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