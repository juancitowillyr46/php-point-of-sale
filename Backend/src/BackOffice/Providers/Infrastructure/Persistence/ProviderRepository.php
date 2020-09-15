<?php
namespace App\BackOffice\Providers\Infrastructure\Persistence;

use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Providers\Domain\Repository\ProviderRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class ProviderRepository extends BaseRepository implements ProviderRepositoryInterface
{
    public ProviderModel $ProviderModel;

    public function __construct(ProviderModel $ProviderModel)
    {
        $this->ProviderModel = $ProviderModel;
        $this->setModel($ProviderModel);
    }

    public function addProvider(array $Provider): bool
    {
        try {
            $addProvider = $this->ProviderModel::create($Provider);
            return $addProvider->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editProvider(int $id, array $userType): bool
    {
        try {
            $editProvider = $this->ProviderModel::all()->find($id);
            return $editProvider->update($userType);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findProvider(int $id): array
    {
        $findProvider = $this->ProviderModel::all()->find($id);
        return $findProvider->toArray();
    }

    public function removeProvider(int $id): bool
    {
        try {
            $editProvider = $this->ProviderModel::all()->find($id);
            $editProvider->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editProvider->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allProviders(array $query): array
    {
        $findAllProvider = $this->ProviderModel::all();
        $getQuery = [];
        if(count($query)) {
            $getQuery = $findAllProvider->where('active', '=', (boolean) $query['active'])->toArray();
        } else {
            $getQuery = $findAllProvider->toArray();
        }
        return $getQuery;
    }

}