<?php
namespace App\BackOffice\Security\Domain\Services;

use App\BackOffice\Security\Domain\Exceptions\UserBlockedException;
use Exception;

class BlockedUserService extends Securityservice
{
    public function executeBoolean(object $bodyParsed): bool {

        try {

            $login = $this->securityRepository->searchUserByUsername($bodyParsed->username);

            $blocked = ($login->blocked == 1);

            if(is_bool($blocked) && $blocked){
                throw new UserBlockedException();
            }

            return $blocked;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}