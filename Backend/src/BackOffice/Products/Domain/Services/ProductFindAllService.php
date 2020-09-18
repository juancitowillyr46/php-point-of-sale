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
            foreach ($findProductAll->registers as $product) {
                $product['measure_unit'] = $this->findNameResourceByUIdRegister($product['id_unit_measurent'], 'TABLE_UNIT_MEASUREMENT');
                $listProduct[] = $this->productMapper->autoMapper->map($product, ProductDto::class);
            }
            $findProductAll->registers = $listProduct;
            return $findProductAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}