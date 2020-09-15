<?php
namespace App\BackOffice\PurchasesDetail\Infrastructure\Persistence;

use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailModel;
use App\BackOffice\PurchasesDetail\Domain\Repository\PurchaseDetailRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class PurchaseDetailRepository extends BaseRepository implements PurchaseDetailRepositoryInterface
{
    private PurchaseDetailModel $purchaseDetailModel;

    public function __construct(PurchaseDetailModel $purchaseDetailModel)
    {
        $this->purchaseDetailModel = $purchaseDetailModel;
        $this->setModel($purchaseDetailModel);
    }

    public function addPurchaseDetail(array $purchaseDetail): bool
    {
        try {
            $addPurchaseDetail = $this->purchaseDetailModel::create($purchaseDetail);
            return $addPurchaseDetail->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editPurchaseDetail(int $id, array $purchaseDetail): bool
    {
        try {
            $editPurchaseDetail = $this->purchaseDetailModel::all()->find($id);
            return $editPurchaseDetail->update($purchaseDetail);
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

    public function allPurchasesDetails(int $purchaseId, array $query): array
    {
        $findAllPurchaseDetail = $this->purchaseDetailModel::all();

        $getQuery = [];
        if(count($query)) {
            $getQuery = $findAllPurchaseDetail
                ->where('buy_id', '=', $purchaseId)
                ->where('active', '=', (boolean) $query['active'])
                ->toArray();
        } else {
            $getQuery = $findAllPurchaseDetail->where('buy_id', '=', $purchaseId)->toArray();
        }
        return $getQuery;
    }
}