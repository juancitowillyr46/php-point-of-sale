<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\Shared\Exception\Commands\AddActionException;
use Exception;

class DataMasterAddService extends DataMasterService
{
    public function execute(object $bodyParsed): object {
        try {

            $this->dataMasterEntity->payload($bodyParsed);
            $this->validateDuplicate($bodyParsed->type, $bodyParsed->idRegister, $this->dataMasterEntity->getUuid());
            $success = $this->dataMasterRepository->addDataMaster((array) $this->dataMasterEntity);
            if(!$success) {
                throw new AddActionException();
            }

            return $this->dataMasterEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}