<?php
namespace App\BackOffice\Permissions\Infrastructure\Persistence;

use App\BackOffice\Permissions\Domain\Entities\PermissionModel;
use App\BackOffice\Permissions\Domain\Repository\PermissionRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public PermissionModel $permissionModel;

    public function __construct(PermissionModel $permissionModel)
    {
        $this->permissionModel = $permissionModel;
        $this->setModel($permissionModel);
    }

    public function addPermission(array $permission): bool
    {
        try {
            $addPermission = $this->permissionModel::create($permission);
            return $addPermission->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editPermission(int $id, array $permission): bool
    {
        try {
            $editPermission = $this->permissionModel::all()->find($id);
            return $editPermission->update($permission);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findPermission(int $id): array
    {
        $findPermission = $this->permissionModel::all()->find($id);
        return $findPermission->toArray();
    }

    public function removePermission(int $id): bool
    {
        try {
            $editPermission = $this->permissionModel::all()->find($id);
            $editPermission->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editPermission->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allPermissions(array $query): object
    {
        return $this->paginateModel($query, $this->permissionModel);
    }

    public function commonPermissions(): array
    {
        try {

            return $this->permissionModel::all()
                ->where('active', '=', true)
                ->toArray();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }


}