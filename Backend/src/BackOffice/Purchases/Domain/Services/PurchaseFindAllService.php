<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\Purchases\Domain\Entities\PurchaseDto;
use Exception;

class PurchaseFindAllService extends PurchaseService
{
    public function executeCollectionPagination(array $query): object {
        try {

            $findPurchaseAll = $this->purchaseRepository->allPurchases($query);
            $listPurchase = [];
            foreach ($findPurchaseAll->registers as $purchase) {
                $listPurchase[] = $this->purchaseMapper->autoMapper->map($purchase, PurchaseDto::class);
            }

            $findPurchaseAll->registers = $listPurchase;
            return $findPurchaseAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}