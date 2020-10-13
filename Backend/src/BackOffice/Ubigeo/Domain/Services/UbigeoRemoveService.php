<?php
namespace App\BackOffice\Ubigeo\Domain\Services;

use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class UbigeoRemoveService extends Ubigeoservice
{
    public function executeArg(string $uuid): object {
        try {

            $findUbigeo = $this->findResourceByUuid(new UbigeoModel(), $uuid);
            $success = $this->ubigeoRepository->removeUbigeo((int) $findUbigeo);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->ubigeoEntity->setUuid($uuid);
            return $this->ubigeoEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}