<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderDto;
use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use App\Shared\Domain\Entities\CommonDto;
use Exception;

class ProviderFindAllService extends ProviderService
{

    public function executeCollectionPagination(array $query): object {

        try {

            $this->validatePagerParameters($query);

            $findProviderAll = $this->providerRepository->allProviders($query);
            $listUser = [];
            foreach ($findProviderAll->rows as $provider) {
                $departmentId = $this->getAttributeById(new UbigeoModel(), $provider['department_id'], 'uuid');
                $provinceId = $this->getAttributeById(new UbigeoModel(), $provider['province_id'], 'uuid');
                $districtId = $this->getAttributeById(new UbigeoModel(), $provider['district_id'], 'uuid');

                $provider['department_uuid'] = $departmentId;
                $provider['province_uuid'] = $provinceId;
                $provider['district_uuid'] = $districtId;
                $listUser[] = $this->providerMapper->autoMapper->map($provider, ProviderDto::class);
            }

            $findProviderAll->rows = $listUser;
            return $findProviderAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function executeCommon(): array
    {
        try {

            $findPermissionAll = $this->providerRepository->commonProviders();
            $listPermission = [];
            foreach ($findPermissionAll as $permission) {
                $listPermission[] = $this->providerMapper->autoMapper->map($permission, CommonDto::class);
            }

            return $listPermission;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}