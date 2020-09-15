<?php
namespace App\BackOffice\PurchasesDetail\Domain\Services;

use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailDto;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailModel;
use Exception;

class PurchaseDetailFindService extends PurchaseDetailService
{
    public function executeArgDetail(string $purchaseId, string $purchaseDetailId): object {
        try {

            // Purchase
            $this->findResourceByUuid(new PurchaseModel(), $purchaseId);

            // Detail
            $findPurchaseId = $this->findResourceByUuid(new PurchaseDetailModel(), $purchaseDetailId);
            $findPurchase = $this->purchaseDetailRepository->findPurchaseDetail($findPurchaseId);

            return $this->purchaseDetailMapper->autoMapper->map($findPurchase, PurchaseDetailDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}