<?php
namespace App\BackOffice\Roles\Domain\Services;

use App\BackOffice\Roles\Domain\Entities\RoleDto;
use App\Shared\Domain\Entities\CommonDto;
use Exception;

class RoleFindAllService extends RoleService
{

    public function executeCollectionPagination(array $query): object {
        try {

            $findRoleAll = $this->roleRepository->allRoles($query);
            $listRole = [];
            foreach ($findRoleAll->rows as $role) {
                $listRole[] = $this->roleMapper->autoMapper->map($role, RoleDto::class);
            }
            $findRoleAll->rows = $listRole;
            return $findRoleAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

    public function executeCommon(): array
    {
        try {

            $findRoleAll = $this->roleRepository->commonRoles();
            $listRole = [];
            foreach ($findRoleAll as $role) {
                $listRole[] = $this->commonMapper->autoMapper->map($role, CommonDto::class);
            }

            return $listRole;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }


}