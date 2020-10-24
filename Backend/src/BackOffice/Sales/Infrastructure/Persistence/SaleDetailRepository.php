<?php
namespace App\BackOffice\Sales\Infrastructure\Persistence;

use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailModel;
use App\BackOffice\Sales\Domain\Repository\SaleDetailRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class SaleDetailRepository extends BaseRepository implements SaleDetailRepositoryInterface
{
    private SaleDetailModel $saleDetailModel;

    public function __construct(SaleDetailModel $saleDetailModel) {
        $this->saleDetailModel = $saleDetailModel;
        $this->setModel($saleDetailModel);
    }

    public function addSaleDetail(array $sale): bool
    {
        try {
            $addPurchaseDetail = $this->saleDetailModel::create($sale);
            return $addPurchaseDetail->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editSaleDetail(int $id, array $sale): bool
    {
        try {
            $editPurchaseDetail = $this->saleDetailModel::all()->find($id);
            return $editPurchaseDetail->update($sale);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findSaleDetail(int $id): array
    {
        $findPurchaseDetail = $this->saleDetailModel::all()->find($id);
        return $findPurchaseDetail->toArray();
    }

    public function removeSaleDetail(int $id): bool
    {
        try {
            $editPurchaseDetail = $this->saleDetailModel::all()->find($id);
            $editPurchaseDetail->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editPurchaseDetail->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allPurchasesDetail(array $query): object
    {
        return $this->paginateModel($query, $this->saleDetailModel);
    }
}