<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class DataMasterRemoveService extends DataMasterService
{
    public function executeArg(string $uuid): object {
        try {

            $findDataMaster = $this->findResourceByUuid(new DataMasterModel(), $uuid);
            $success = $this->dataMasterRepository->removeDataMaster((int) $findDataMaster);

            if(!$success) {
                throw new RemoveActionException();
            }
            $this->dataMasterEntity->setUuid($uuid);
            return $this->dataMasterEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}