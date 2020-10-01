<?php
namespace App\BackOffice\Roles\Domain\Services;

use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class RoleAddService extends RoleService
{

    public function execute(object $bodyParsed): object
    {
        try {

            $this->roleEntity->payload($bodyParsed);
            $success = $this->roleRepository->addRole(((array) $this->roleEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->roleEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}