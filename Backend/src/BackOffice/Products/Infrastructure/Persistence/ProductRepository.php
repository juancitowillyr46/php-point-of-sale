<?php
namespace App\BackOffice\Products\Infrastructure\Persistence;

use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Products\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;
use Psr\Log\LoggerInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    private ProductModel $productModel;

    public function __construct(ProductModel $productModel)
    {
        $this->productModel = $productModel;
        $this->setModel($productModel);
    }

    public function addProduct(array $product): bool
    {
        try {
            $addProduct = $this->productModel::create($product);
            return $addProduct->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editProduct(int $id, array $product): bool
    {
        try {
            $editProduct = $this->productModel::all()->find($id);
            return $editProduct->update($product);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findProduct(int $id): array
    {
        $findProduct = $this->productModel::all()->find($id);
        return $findProduct->toArray();
    }

    public function removeProduct(int $id): bool
    {
        try {
            $editProduct = $this->productModel::all()->find($id);
            $editProduct->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editProduct->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allProduct(array $query): object
    {
        return $this->paginateModel($query, $this->productModel);
    }

    public function countProducts(): int {
        return $this->productModel::withTrashed()->count();
    }
}