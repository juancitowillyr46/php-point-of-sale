<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class PurchaseRemoveService extends PurchaseService
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new PurchaseModel(), $uuid);
            $success = $this->purchaseRepository->removePurchase((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->purchaseEntity->setUuid($uuid);
            return $this->purchaseEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}