<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterDto;
use Exception;

class DataMasterFindAllService extends DataMasterService
{
    public function executeCollectionPagination(array $query): object {

        try {

            $this->validatePagerParameters($query);

            $findDataMasterAll = $this->dataMasterRepository->allDataMaster($query);
            $listDataMaster = [];
            foreach ($findDataMasterAll->registers as $dataMaster) {
                $listDataMaster[] = $this->dataMasterMapper->autoMapper->map($dataMaster, DataMasterDto::class);
            }

            $findDataMasterAll->registers = $listDataMaster;
            return $findDataMasterAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}