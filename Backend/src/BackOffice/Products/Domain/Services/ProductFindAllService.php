<?php


namespace App\BackOffice\Products\Domain\Services;


use App\BackOffice\Products\Domain\Entities\ProductDto;
use Exception;

class ProductFindAllService extends ProductService
{
    public function executeCollectionPagination(array $query): object {
        try {

            $findProductAll = $this->productRepository->allProduct($query);
            $listProduct = [];
            foreach ($findProductAll->rows as $product) {
                $product['measure_unit'] = $this->findNameResourceByUIdRegister($product['unit_measurent_id'], 'TABLE_UNIT_MEASUREMENT');
                $product['measure_unit_id'] = $this->getUuidDataMaster($product['unit_measurent_id'], 'TABLE_UNIT_MEASUREMENT');
                $listProduct[] = $this->productMapper->autoMapper->map($product, ProductDto::class);
            }
            $findProductAll->rows = $listProduct;
            return $findProductAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}