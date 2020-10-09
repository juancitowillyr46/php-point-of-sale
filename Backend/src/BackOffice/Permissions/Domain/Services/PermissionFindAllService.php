<?php
namespace App\BackOffice\Permissions\Domain\Services;

use App\BackOffice\Permissions\Domain\Entities\PermissionDto;
use App\Shared\Domain\Entities\CommonDto;
use Exception;

class PermissionFindAllService extends PermissionService
{

    public function executeCollectionPagination(array $query): object {
        try {

            $findPermissionAll = $this->permissionRepository->allPermissions($query);
            $listPermission = [];
            foreach ($findPermissionAll->rows as $permission) {
                $listPermission[] = $this->permissionMapper->autoMapper->map($permission, PermissionDto::class);
            }
            $findPermissionAll->rows = $listPermission;
            return $findPermissionAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

    public function executeCommon(): array
    {
        try {

            $findPermissionAll = $this->permissionRepository->commonPermissions();
            $listPermission = [];
            foreach ($findPermissionAll as $permission) {
                $listPermission[] = $this->commonMapper->autoMapper->map($permission, CommonDto::class);
            }

            return $listPermission;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }


}