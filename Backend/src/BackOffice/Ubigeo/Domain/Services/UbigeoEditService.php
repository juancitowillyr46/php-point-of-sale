<?php
namespace App\BackOffice\Ubigeo\Domain\Services;

use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class UbigeoEditService extends Ubigeoservice
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findUbigeo = $this->findResourceByUuid(new UbigeoModel(), $uuid);

            $this->ubigeoEntity->payload($bodyParsed);
            $success = $this->ubigeoRepository->editUbigeo($findUbigeo, ((array) $this->ubigeoEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->ubigeoEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}