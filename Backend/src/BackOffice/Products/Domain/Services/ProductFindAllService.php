<?php


namespace App\BackOffice\Products\Domain\Services;


use App\BackOffice\Products\Domain\Entities\ProductDto;
use Exception;

class ProductFindAllService extends ProductService
{
    public function executeCollection(array $query): array {
        try {

            $findProductAll = $this->productRepository->allProduct($query);
            $listProduct = [];
            foreach ($findProductAll as $product) {
                $product['measure_unit'] = $this->findNameResourceByUIdRegister($product['id_unit_measurent'], 'TABLE_UNIT_MEASUREMENT');
                $listProduct[] = $this->productMapper->autoMapper->map($product, ProductDto::class);
            }
            return $listProduct;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}