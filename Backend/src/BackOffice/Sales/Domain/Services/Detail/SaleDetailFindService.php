<?php


namespace App\BackOffice\Sales\Domain\Services\Detail;


use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailDto;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailModel;
use App\BackOffice\Sales\Domain\Entities\SaleModel;
use Exception;

class SaleDetailFindService extends SaleDetailService
{
    public function executeArgs(string $saleDetailUuid, string $saleUuid): object {
        try {

            $this->findResourceByUuid(new SaleModel(), $saleUuid);

            $this->findCompareIdWithArg($saleUuid, $saleUuid);

            $findResourceId = $this->findResourceByUuid(new SaleDetailModel(), $saleDetailUuid);

            $saleDetail = $this->saleDetailRepository->findSaleDetail($findResourceId);

            $productId = (int) $saleDetail['product_id'];
            $saleDetail['product_uuid'] = $this->getAttributeById(new ProductModel(), $productId, "uuid");
            $saleDetail['product_name'] = $this->getAttributeById(new ProductModel(), $productId, "name");

            $saleId = (int) $saleDetail['sale_id'];
            $saleDetail['sale_uuid'] = $this->getAttributeById(new SaleModel(), $saleId, "uuid");

            return $this->saleDetailMapper->autoMapper->map($saleDetail, SaleDetailDto::class);

        } catch (Exception $ex) {

            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}