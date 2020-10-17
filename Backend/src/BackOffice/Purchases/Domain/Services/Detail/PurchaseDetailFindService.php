<?php


namespace App\BackOffice\Purchases\Domain\Services\Detail;


use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailDto;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use Exception;

class PurchaseDetailFindService extends PurchaseDetailService
{
    public function executeArgs(string $purchaseDetailUuid, string $purchaseUuid): object {
        try {

            $this->findResourceByUuid(new PurchaseModel(), $purchaseUuid);

            $this->findCompareIdWithArg($purchaseUuid, $purchaseUuid);

            $findResourceId = $this->findResourceByUuid(new PurchaseDetailModel(), $purchaseDetailUuid);

            $purchaseDetail = $this->purchaseDetailRepository->findPurchaseDetail($findResourceId);

            $productId = (int) $purchaseDetail['product_id'];
            $purchaseDetail['product_uuid'] = $this->getAttributeById(new ProductModel(), $productId, "uuid");
            $purchaseDetail['product_name'] = $this->getAttributeById(new ProductModel(), $productId, "name");

            $purchaseId = (int) $purchaseDetail['purchase_id'];
            $purchaseDetail['purchase_uuid'] = $this->getAttributeById(new PurchaseModel(), $purchaseId, "uuid");

            return $this->purchaseDetailMapper->autoMapper->map($purchaseDetail, PurchaseDetailDto::class);

        } catch (Exception $ex) {

            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}