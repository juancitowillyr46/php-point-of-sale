<?php
namespace App\BackOffice\Sales\Infrastructure\Persistence;

use App\BackOffice\Sales\Domain\Entities\SaleModel;
use App\BackOffice\Sales\Domain\Repository\SaleRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;
use Psr\Log\LoggerInterface;

class SaleRepository extends BaseRepository implements SaleRepositoryInterface
{
    private SaleModel $saleModel;

    public function __construct(SaleModel $saleModel) {
        $this->saleModel = $saleModel;
        $this->setModel($saleModel);
    }

    public function addSale(array $sale): bool
    {
        try {
            $addPurchase = $this->saleModel::create($sale);
            return $addPurchase->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode(), $this->loggerInterface);
        }
    }

    public function editSale(int $id, array $sale): bool
    {
        try {
            $editPurchase = $this->saleModel::all()->find($id);
            return $editPurchase->update($sale);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findSale(int $id): array
    {
        $findPurchase = $this->saleModel::all()->find($id);
        return $findPurchase->toArray();
    }

    public function removeSale(int $id): bool
    {
        try {
            $editPurchase = $this->saleModel::all()->find($id);
            $editPurchase->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editPurchase->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allPurchases(array $query): object
    {
        return $this->paginateModel($query, $this->saleModel);
    }
}