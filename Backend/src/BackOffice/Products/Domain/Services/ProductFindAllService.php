<?php


namespace App\BackOffice\Products\Domain\Services;


use App\BackOffice\Products\Domain\Entities\ProductDto;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\Shared\Domain\Entities\CommonDto;
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

    public function executeGetProductsByProvider(string $providerId) {
        try {
            $id = $this->findResourceByUuid(new ProviderModel(), $providerId);
            $findProviderAll = $this->productRepository->getProductsByProvider($id);

            $listProvider = [];
            foreach ($findProviderAll as $provider) {
                $listProvider[] = $this->productMapper->autoMapper->map($provider, CommonDto::class);
            }
            return $listProvider;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }


}