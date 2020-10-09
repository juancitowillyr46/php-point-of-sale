<?php
namespace App\BackOffice\Providers\Infrastructure\Persistence;

use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Providers\Domain\Repository\ProviderRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class ProviderRepository extends BaseRepository implements ProviderRepositoryInterface
{
    public ProviderModel $providerModel;

    public function __construct(ProviderModel $providerModel)
    {
        $this->providerModel = $providerModel;
        $this->setModel($providerModel);
    }

    public function addProvider(array $Provider): bool
    {
        try {
            $addProvider = $this->providerModel::create($Provider);
            return $addProvider->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editProvider(int $id, array $userType): bool
    {
        try {
            $editProvider = $this->providerModel::all()->find($id);
            return $editProvider->update($userType);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findProvider(int $id): array
    {
        $findProvider = $this->providerModel::all()->find($id);
        return $findProvider->toArray();
    }

    public function removeProvider(int $id): bool
    {
        try {
            $editProvider = $this->providerModel::all()->find($id);
            $editProvider->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editProvider->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allProviders(array $query): array
    {
        $findAllProvider = $this->providerModel::all();
        $getQuery = [];
        if(count($query)) {
            $getQuery = $findAllProvider->where('active', '=', (boolean) $query['active'])->toArray();
        } else {
            $getQuery = $findAllProvider->toArray();
        }
        return $getQuery;
    }

    public function commonProviders(): array
    {
        try {

            return $this->providerModel::all()
                ->where('active', '=', true)
                ->toArray();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}