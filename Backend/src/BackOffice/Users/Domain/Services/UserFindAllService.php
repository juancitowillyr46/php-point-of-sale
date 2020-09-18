<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Entities\UserDto;
use Exception;

class UserFindAllService extends UserService
{
    public function executeCollectionPagination(array $query): object {

        try {

            $this->validatePagerParameters($query);

            $findUserAll = $this->userRepository->allUsers($query);
            $listUser = [];
            foreach ($findUserAll->registers as $user) {
                $user['user_type'] = $this->findNameResourceByUIdRegister($user['user_type_id'], 'TABLE_TYPE_USER');
                $listUser[] = $this->userMapper->autoMapper->map($user, UserDto::class);
            }

            $findUserAll->registers = $listUser;
            return $findUserAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}