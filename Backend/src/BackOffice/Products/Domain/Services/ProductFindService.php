<?php
namespace App\BackOffice\Products\Domain\Services;


use App\BackOffice\Products\Domain\Entities\ProductDto;
use App\BackOffice\Products\Domain\Entities\ProductModel;
use Exception;

class ProductFindService extends ProductService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new ProductModel(), $uuid);
            $findProduct = $this->productRepository->findProduct($findResourceId);
            $findProduct['measure_unit'] = $this->findNameResourceByUIdRegister($findProduct['unit_measurent_id'], 'TABLE_UNIT_MEASUREMENT');
            $findProduct['measure_unit_id'] = $this->getUuidDataMaster($findProduct['unit_measurent_id'], 'TABLE_UNIT_MEASUREMENT');
            return $this->productMapper->autoMapper->map($findProduct, ProductDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}