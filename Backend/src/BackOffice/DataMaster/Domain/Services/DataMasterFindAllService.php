<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterDto;
use Exception;

class DataMasterFindAllService extends DataMasterService
{
    public function executeCollection(array $query): array {

        try {

            $findDataMasterAll = $this->dataMasterRepository->allDataMaster($query);
            $listDataMaster = [];
            foreach ($findDataMasterAll as $dataMaster) {
                $listDataMaster[] = $this->dataMasterMapper->autoMapper->map($dataMaster, DataMasterDto::class);
            }
            return $listDataMaster;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}