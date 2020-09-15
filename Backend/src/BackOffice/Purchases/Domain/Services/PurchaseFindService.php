<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\Purchases\Domain\Entities\PurchaseDto;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use Exception;

class PurchaseFindService extends PurchaseService
{
    public function executeArg(string $uuid): object {
        try {

            $findResourceId = $this->findResourceByUuid(new PurchaseModel(), $uuid);
            $findPurchase = $this->purchaseRepository->findPurchase($findResourceId);
            return $this->purchaseMapper->autoMapper->map($findPurchase, PurchaseDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}