<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\Shared\Exception\Commands\AddActionException;
use Exception;

class DataMasterAddService extends DataMasterService
{
    public function execute(object $bodyParsed): object {
        try {

            $assignedId = $this->getAssignedId($bodyParsed->type);
            //$this->validateDuplicate($bodyParsed->type, $assignedId, $this->dataMasterEntity->getUuid());
            $this->dataMasterEntity->setIdRegister($assignedId);
            $this->dataMasterEntity->payload($bodyParsed);
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