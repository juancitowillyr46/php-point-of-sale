<?php
namespace App\BackOffice\Ubigeo\Infrastructure\Persistence;

use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use App\BackOffice\Ubigeo\Domain\Repository\UbigeoRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class UbigeoRepository extends BaseRepository implements UbigeoRepositoryInterface
{
    public UbigeoModel $ubigeoModel;

    public function __construct(UbigeoModel $ubigeoModel)
    {
        $this->ubigeoModel = $ubigeoModel;
        $this->setModel($ubigeoModel);
    }

    public function addUbigeo(array $ubigeo): bool
    {
        try {
            $addUbigeo = $this->ubigeoModel::create($ubigeo);
            return $addUbigeo->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editUbigeo(int $id, array $ubigeo): bool
    {
        try {
            $editUbigeo = $this->ubigeoModel::all()->find($id);
            return $editUbigeo->update($ubigeo);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findUbigeo(int $id): array
    {
        $findUbigeo = $this->ubigeoModel::all()->find($id);
        return $findUbigeo->toArray();
    }

    public function removeUbigeo(int $id): bool
    {
        try {
            $editUbigeo = $this->ubigeoModel::all()->find($id);
            $editUbigeo->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editUbigeo->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allUbigeo(array $query): object
    {
        return $this->paginateModel($query, $this->ubigeoModel);
    }

    public function commonUbigeoDepartments(): array
    {
        try {

           $result = $this->ubigeoModel::select('uuid','name','id')
                ->where('active', '=', true)
                ->where('department_id', '!=', 0)
                ->where('province_id', '=', 0)
                ->where('district_id', '=', 0)
                ->get();
            return $result->toArray();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function commonUbigeoProvinces(int $department_id): array
    {
        try {

            $result = $this->ubigeoModel::select('uuid','name','id')
                ->where('active', '=', true)
                ->where('department_id', '=', $department_id)
                ->where('province_id', '!=', 0)
                ->where('district_id', '=', 0)
                ->get();
            return $result->toArray();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function commonUbigeoDistricts(int $department_id, int $province_id): array
    {
        try {

            $result = $this->ubigeoModel::select('uuid','name','id')
                ->where('active', '=', true)
                ->where('department_id', '=', $department_id)
                ->where('province_id', '=', $province_id)
                ->where('district_id', '!=', 0)
                ->get();
            return $result->toArray();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getIdCommonUbigeo(string $type = '', string $uuid = ''): int {
        $idUbigeo = 0;
        if($type == 'DEPARTMENT'){
            $rsUbigeo = $this->ubigeoModel::all()
                ->where('active', '=', true)
                ->where('uuid', '=', $uuid)->first();
            $idUbigeo = $rsUbigeo['department_id'];
        } else if($type == 'PROVINCE'){
            $rsUbigeo = $this->ubigeoModel::all()
                ->where('active', '=', true)
                ->where('uuid', '=', $uuid)->first();
            $idUbigeo = $rsUbigeo['province_id'];
        }
        return $idUbigeo;
    }

}