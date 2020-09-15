<?php
namespace App\BackOffice\Purchases\Infrastructure\Persistence;

use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\BackOffice\Purchases\Domain\Repository\PurchaseRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class PurchaseRepository extends BaseRepository implements PurchaseRepositoryInterface
{
    private PurchaseModel $purchaseModel;

    public function __construct(PurchaseModel $purchaseModel)
    {
        $this->purchaseModel = $purchaseModel;
        $this->setModel($purchaseModel);
    }

    public function addPurchase(array $purchase): bool
    {
        try {
            $addPurchase = $this->purchaseModel::create($purchase);
            return $addPurchase->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editPurchase(int $id, array $purchase): bool
    {
        try {
            $editPurchase = $this->purchaseModel::all()->find($id);
            return $editPurchase->update($purchase);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findPurchase(int $id): array
    {
        $findPurchase = $this->purchaseModel::all()->find($id);
        return $findPurchase->toArray();
    }

    public function removePurchase(int $id): bool
    {
        try {
            $editPurchase = $this->purchaseModel::all()->find($id);
            $editPurchase->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editPurchase->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allPurchases(array $query): array
    {
        $findAllPurchase = $this->purchaseModel::all();
        $getQuery = [];
        if(count($query)) {
            $getQuery = $findAllPurchase->where('active', '=', (boolean) $query['active'])->toArray();
        } else {
            $getQuery = $findAllPurchase->toArray();
        }
        return $getQuery;
    }
}