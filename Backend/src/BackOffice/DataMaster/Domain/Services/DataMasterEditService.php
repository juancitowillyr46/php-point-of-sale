<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class DataMasterEditService extends DataMasterService
{
    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $findDataMaster = $this->findResourceByUuid(new DataMasterModel(), $uuid);
            $this->dataMasterEntity->payload($bodyParsed);
            //$this->validateDuplicate($bodyParsed->type, $bodyParsed->idRegister, $this->dataMasterEntity->getUuid());
            $success = $this->dataMasterRepository->editDataMaster((int) $findDataMaster, (array) $this->dataMasterEntity);
            if(!$success) {
                throw new EditActionException();
            }

            return $this->dataMasterEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}