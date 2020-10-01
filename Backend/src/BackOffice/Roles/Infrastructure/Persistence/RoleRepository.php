<?php
namespace App\BackOffice\Roles\Infrastructure\Persistence;

use App\BackOffice\Roles\Domain\Entities\RoleModel;
use App\BackOffice\Roles\Domain\Repository\RoleRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public RoleModel $roleModel;

    public function __construct(RoleModel $roleModel)
    {
        $this->roleModel = $roleModel;
        $this->setModel($roleModel);
    }

    public function addRole(array $role): bool
    {
        try {
            $addRole = $this->roleModel::create($role);
            return $addRole->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editRole(int $id, array $role): bool
    {
        try {
            $editRole = $this->roleModel::all()->find($id);
            return $editRole->update($role);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findRole(int $id): array
    {
        $findRole = $this->roleModel::all()->find($id);
        return $findRole->toArray();
    }

    public function removeRole(int $id): bool
    {
        try {
            $editRole = $this->roleModel::all()->find($id);
            $editRole->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editRole->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allRoles(array $query): object
    {
        return $this->paginateModel($query, $this->roleModel);
    }

    public function commonRoles(): array
    {
        try {

            return $this->roleModel::all()
                ->where('active', '=', true)
                ->toArray();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}