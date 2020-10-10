<?php
namespace App\BackOffice\DataMaster\Infrastructure\Persistence;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\DataMaster\Domain\Repository\DataMasterRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;

class DataMasterRepository extends BaseRepository implements DataMasterRepositoryInterface
{
    private DataMasterModel $dataMasterModel;

    public function __construct(DataMasterModel $dataMasterModel)
    {
        $this->setModel($dataMasterModel);
        $this->dataMasterModel = $dataMasterModel;
    }

    public function addDataMaster(array $dataMaster): bool
    {
        try {
            $addDataMaster = $this->dataMasterModel::create($dataMaster);
            return $addDataMaster->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editDataMaster(int $id, array $dataMaster): bool
    {
        try {
            $editDataMaster = $this->dataMasterModel::all()->find($id);
            return $editDataMaster->update($dataMaster);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findDataMaster(int $id): array
    {
        $findDataMaster = $this->dataMasterModel::all()->find($id);
        return $findDataMaster->toArray();
    }

    public function removeDataMaster(int $id): bool
    {
        try {
            $editDataMaster = $this->dataMasterModel::all()->find($id);
            $editDataMaster->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editDataMaster->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allDataMaster(array $query): object
    {

        return $this->paginateModel($query, $this->dataMasterModel);

//        $findAllDataMaster = $this->dataMasterModel::all();
//
//        $ll = [];
//        if(array_key_exists('active', $query)) {
//            $ll = $findAllDataMaster->where('active', '=', (boolean) $query['active']);
//        }
//
//        if(array_key_exists('type', $query)) {
//            $ll = $findAllDataMaster->where('type', '=', $query['type']);
//        }
//
//        return $ll->toArray();
    }

    public function validateIdRegister(string $key, string $value, string $type, string $uuid): bool {

        return $this->dataMasterModel::all()
                                ->where($key, $value)
                                ->where('type', '=', $type)
                                ->where('uuid', '!=', $uuid)->count();

    }

    public function commonData(string $type): array
    {
        try {

            return $this->dataMasterModel::all()
                ->where('active', '=', true)
                ->where('type', '=', $type)
                ->toArray();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getAssignedId(string $type): int
    {
        try {

            $countRows = $this->dataMasterModel::all()->where('type', '=', $type)->count();

            $assignedId = 1;

            if($countRows > 0) {
                $dataMaster = $this->dataMasterModel::withTrashed()->select("type", DB::raw("(MAX(id_register) + 1) as id"))
                    ->groupBy('type')
                    ->where('type', '=', $type)
                    ->first();
                $assignedId = $dataMaster->id;
            }

            return $assignedId;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }


}