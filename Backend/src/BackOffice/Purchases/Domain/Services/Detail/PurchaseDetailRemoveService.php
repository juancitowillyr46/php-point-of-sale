<?php


namespace App\BackOffice\Purchases\Domain\Services\Detail;


use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class PurchaseDetailRemoveService extends PurchaseDetailService
{
    public function executeArgs(string $purchaseDetailId, string $purchaseId): object {
        try {

            $this->findResourceByUuid(new PurchaseModel(), $purchaseId);

            $findUser = $this->findResourceByUuid(new PurchaseDetailModel(), $purchaseDetailId);
            $success = $this->purchaseDetailRepository->removePurchaseDetail((int) $findUser);
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