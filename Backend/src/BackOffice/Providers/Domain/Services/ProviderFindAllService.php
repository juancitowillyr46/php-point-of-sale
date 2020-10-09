<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderDto;
use App\Shared\Domain\Entities\CommonDto;
use Exception;

class ProviderFindAllService extends ProviderService
{

    public function executeCollection(array $query): array {
        try {

            $findUserAll = $this->providerRepository->allProviders($query);
            $listUser = [];
            foreach ($findUserAll as $userType) {
                $listUser[] = $this->providerMapper->autoMapper->map($userType, ProviderDto::class);
            }
            return $listUser;

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