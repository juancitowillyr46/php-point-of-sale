<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\Purchases\Domain\Entities\PurchaseDto;
use Exception;

class PurchaseFindAllService extends PurchaseService
{
    public function executeCollection(array $query): array {
        try {

            $findPurchaseAll = $this->purchaseRepository->allPurchases($query);
            $listPurchase = [];
            foreach ($findPurchaseAll as $purchase) {
                $listPurchase[] = $this->purchaseMapper->autoMapper->map($purchase, PurchaseDto::class);
            }
            return $listPurchase;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}