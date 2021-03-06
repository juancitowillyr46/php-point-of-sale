<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterDto;
use App\Shared\Domain\Entities\CommonBooleanDto;
use App\Shared\Domain\Entities\CommonDto;
use App\Shared\Domain\Entities\CommonMapper;
use Exception;

class DataMasterFindAllService extends DataMasterService
{
    public function executeCollectionPagination(array $query): object {

        try {

            $this->validatePagerParameters($query);

            $findDataMasterAll = $this->dataMasterRepository->allDataMaster($query);
            $listDataMaster = [];
            foreach ($findDataMasterAll->rows as $dataMaster) {
                $listDataMaster[] = $this->dataMasterMapper->autoMapper->map($dataMaster, DataMasterDto::class);
            }

            $findDataMasterAll->rows = $listDataMaster;
            return $findDataMasterAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonAuditStatus(): array
    {
        try {

            return $this->commonSetItems('TABLE_STATE_AUDIT', CommonBooleanDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonBlockedUser(): array {
        try {

            return $this->commonSetItems('TABLE_BLOCKED_USER', CommonBooleanDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonUnitMeasurement(): array {
        try {

            return $this->commonSetItems('TABLE_UNIT_MEASUREMENT', CommonDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonDocumentTypes(): array {
        try {

            return $this->commonSetItems('TABLE_DOCUMENT_TYPE', CommonDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonTypeTaxDocument(): array {
        try {

            return $this->commonSetItems('TABLE_DOCUMENT_TYPE_TAX', CommonDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonStatusPurchase(): array {
        try {

            return $this->commonSetItems('TABLE_STATUS_PURCHASE', CommonDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    private function commonSetItems(string $type, $dto): array {
        try {

            $findCommonAll = $this->dataMasterRepository->commonData($type);
            $listCommon = [];
            foreach ($findCommonAll as $common) {
                $listCommon[] = $this->commonMapper->autoMapper->map($common, $dto);
            }

            return $listCommon;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonDataType(): array {
        try {

            $findCommonAll = $this->dataMasterRepository->commonDataType();
            $listCommon = [];
            foreach ($findCommonAll as $common) {
                $listCommon[] = $this->commonMapper->autoMapper->map($common, CommonDto::class);
            }

            return $listCommon;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}