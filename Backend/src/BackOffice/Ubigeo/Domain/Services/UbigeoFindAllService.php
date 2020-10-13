<?php
namespace App\BackOffice\Ubigeo\Domain\Services;

use App\BackOffice\Ubigeo\Domain\Entities\UbigeoDto;
use App\Shared\Domain\Entities\CommonDto;
use Exception;

class UbigeoFindAllService extends UbigeoService
{

    public function executeCollectionPagination(array $query): object {
        try {

            $findUbigeoAll = $this->ubigeoRepository->allUbigeo($query);
            $listUbigeo = [];
            foreach ($findUbigeoAll->rows as $ubigeo) {
                $listUbigeo[] = $this->ubigeoMapper->autoMapper->map($ubigeo, UbigeoDto::class);
            }
            $findUbigeoAll->rows = $listUbigeo;
            return $findUbigeoAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

    public function executeCommonDepartments(): array {
        try {

            $findUbigeoAll = $this->ubigeoRepository->commonUbigeoDepartments();
            $listUbigeo = [];
            foreach ($findUbigeoAll as $ubigeo) {
                $listUbigeo[] = $this->commonMapper->autoMapper->map($ubigeo, CommonDto::class);
            }

            return $listUbigeo;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonProvinces(string $department_id): array {
        try {

            $department = $this->ubigeoRepository->getIdCommonUbigeo($type = 'DEPARTMENT', $department_id);

            $findUbigeoAll = $this->ubigeoRepository->commonUbigeoProvinces($department);
            $listUbigeo = [];
            foreach ($findUbigeoAll as $ubigeo) {
                $listUbigeo[] = $this->commonMapper->autoMapper->map($ubigeo, CommonDto::class);
            }

            return $listUbigeo;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommonDistricts(string $department_id, string $province_id): array {
        try {

            $department = $this->ubigeoRepository->getIdCommonUbigeo($type = 'DEPARTMENT', $department_id);
            $province = $this->ubigeoRepository->getIdCommonUbigeo($type = 'PROVINCE', $province_id);

            $findUbigeoAll = $this->ubigeoRepository->commonUbigeoDistricts($department, $province);
            $listUbigeo = [];
            foreach ($findUbigeoAll as $ubigeo) {
                $listUbigeo[] = $this->commonMapper->autoMapper->map($ubigeo, CommonDto::class);
            }

            return $listUbigeo;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}