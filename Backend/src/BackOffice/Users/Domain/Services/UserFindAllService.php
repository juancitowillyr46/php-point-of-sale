<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\UserDto;
use Exception;

class UserFindAllService extends UserService
{
    public function executeCollection(array $query): array {

        try {

            $findUserAll = $this->userRepository->allUsers($query);
            $listUser = [];
            foreach ($findUserAll as $user) {
                $user['user_type'] = $this->findNameResourceByUIdRegister($user['user_type_id'], 'TABLE_TYPE_USER');
                $listUser[] = $this->userMapper->autoMapper->map($user, UserDto::class);
            }
            return $listUser;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}