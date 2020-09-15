<?php
namespace App\BackOffice\PurchasesDetail\Domain\Services;

use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class PurchaseDetailRemoveService extends PurchaseDetailService
{
    public function executeArgDetail(string $purchaseId, string $purchaseDetailId): object {
        try {

            // Purchase
            $this->findResourceByUuid(new PurchaseModel(), $purchaseId);

            // Detail
            $findPurchaseDetailId = $this->findResourceByUuid(new PurchaseDetailModel(), $purchaseDetailId);

            $success = $this->purchaseDetailRepository->removePurchaseDetail((int) $findPurchaseDetailId);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->purchaseDetailEntity->setUuid($purchaseDetailId);
            return $this->purchaseDetailEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}