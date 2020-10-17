<?php
namespace App\BackOffice\Purchases\Infrastructure\Persistence;

use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailModel;
use App\BackOffice\Purchases\Domain\Repository\PurchaseDetailRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class PurchaseDetailRepository extends BaseRepository implements PurchaseDetailRepositoryInterface
{
    private PurchaseDetailModel $purchaseDetailModel;

    public function __construct(PurchaseDetailModel $purchaseDetailModel) {
        $this->purchaseDetailModel = $purchaseDetailModel;
        $this->setModel($purchaseDetailModel);
    }

    public function addPurchaseDetail(array $purchase): bool
    {
        try {
            $addPurchaseDetail = $this->purchaseDetailModel::create($purchase);
            return $addPurchaseDetail->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editPurchaseDetail(int $id, array $purchase): bool
    {
        try {
            $editPurchaseDetail = $this->purchaseDetailModel::all()->find($id);
            return $editPurchaseDetail->update($purchase);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findPurchaseDetail(int $id): array
    {
        $findPurchaseDetail = $this->purchaseDetailModel::all()->find($id);
        return $findPurchaseDetail->toArray();
    }

    public function removePurchaseDetail(int $id): bool
    {
        try {
            $editPurchaseDetail = $this->purchaseDetailModel::all()->find($id);
            $editPurchaseDetail->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editPurchaseDetail->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allPurchasesDetail(array $query): object
    {
        return $this->paginateModel($query, $this->purchaseDetailModel);
    }
}