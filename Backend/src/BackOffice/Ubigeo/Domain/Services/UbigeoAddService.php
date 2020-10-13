<?php
namespace App\BackOffice\Ubigeo\Domain\Services;

use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class UbigeoAddService extends Ubigeoservice
{

    public function execute(object $bodyParsed): object
    {
        try {

            $this->ubigeoEntity->payload($bodyParsed);
            $success = $this->ubigeoRepository->addUbigeo(((array) $this->ubigeoEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->ubigeoEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}