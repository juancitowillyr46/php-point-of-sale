<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterDto;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use Exception;

class DataMasterFindService extends DataMasterService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new DataMasterModel(), $uuid);
            $findDataMaster = $this->dataMasterRepository->findDataMaster($findResourceId);
            return $this->dataMasterMapper->autoMapper->map($findDataMaster, DataMasterDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}