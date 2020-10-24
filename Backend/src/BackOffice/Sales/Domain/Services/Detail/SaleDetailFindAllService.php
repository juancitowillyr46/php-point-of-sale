<?php


namespace App\BackOffice\Sales\Domain\Services\Detail;


use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailDto;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailModel;
use App\BackOffice\Sales\Domain\Entities\SaleModel;
use Exception;

class SaleDetailFindAllService extends SaleDetailService
{
    public function executeCollectionPagination(string $saleUuid, array $query): object {
        try {

            $saleId = $this->findResourceByUuid(new SaleModel(), $saleUuid);

            $findSaleDetailAll = $this->saleDetailRepository->paginateModelParent(new SaleDetailModel(), $query, $saleId, 'sale_id');
            $listSaleDetail = [];
            foreach ($findSaleDetailAll->rows as $saleDetail) {

                $productId = (int) $saleDetail['product_id'];
                $saleDetail['product_uuid'] = $this->getAttributeById(new ProductModel(), $productId, "uuid");
                $saleDetail['product_name'] = $this->getAttributeById(new ProductModel(), $productId, "name");

                $saleId = (int) $saleDetail['sale_id'];
                $saleDetail['sale_uuid'] = $this->getAttributeById(new SaleModel(), $saleId, "uuid");

                $listSaleDetail[] = $this->saleDetailMapper->autoMapper->map($saleDetail, SaleDetailDto::class);
            }

            $findSaleDetailAll->rows = $listSaleDetail;
            return $findSaleDetailAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}