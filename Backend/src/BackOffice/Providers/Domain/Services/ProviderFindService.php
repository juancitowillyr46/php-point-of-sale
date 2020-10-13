<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderDto;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use Exception;

class ProviderFindService extends ProviderService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new ProviderModel(), $uuid);

            $findUser = $this->providerRepository->findProvider($findResourceId);

            $departmentId = $this->getAttributeById(new UbigeoModel(), $findUser['department_id'], 'uuid');
            $provinceId = $this->getAttributeById(new UbigeoModel(), $findUser['province_id'], 'uuid');
            $districtId = $this->getAttributeById(new UbigeoModel(), $findUser['district_id'], 'uuid');

            $findUser['department_uuid'] = $departmentId;
            $findUser['province_uuid'] = $provinceId;
            $findUser['district_uuid'] = $districtId;

            return $this->providerMapper->autoMapper->map($findUser, ProviderDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}