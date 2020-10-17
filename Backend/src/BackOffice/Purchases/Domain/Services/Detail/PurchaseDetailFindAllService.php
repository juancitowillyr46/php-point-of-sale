<?php


namespace App\BackOffice\Purchases\Domain\Services\Detail;


use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailDto;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use Exception;

class PurchaseDetailFindAllService extends PurchaseDetailService
{
    public function executeCollectionPagination(string $purchaseUuid, array $query): object {
        try {

            $purchaseId = $this->findResourceByUuid(new PurchaseModel(), $purchaseUuid);

            $findPurchaseDetailAll = $this->purchaseDetailRepository->paginateModelParent(new PurchaseDetailModel(), $query, $purchaseId, 'purchase_id');
            $listPurchaseDetail = [];
            foreach ($findPurchaseDetailAll->rows as $purchaseDetail) {

                $productId = (int) $purchaseDetail['product_id'];
                $purchaseDetail['product_uuid'] = $this->getAttributeById(new ProductModel(), $productId, "uuid");
                $purchaseDetail['product_name'] = $this->getAttributeById(new ProductModel(), $productId, "name");

                $purchaseId = (int) $purchaseDetail['purchase_id'];
                $purchaseDetail['purchase_uuid'] = $this->getAttributeById(new PurchaseModel(), $purchaseId, "uuid");

                $listPurchaseDetail[] = $this->purchaseDetailMapper->autoMapper->map($purchaseDetail, PurchaseDetailDto::class);
            }

            $findPurchaseDetailAll->rows = $listPurchaseDetail;
            return $findPurchaseDetailAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}