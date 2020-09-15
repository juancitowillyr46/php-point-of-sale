<?php
namespace App\BackOffice\PurchasesDetail\Domain\Services;

use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailDto;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailModel;
use Exception;

class PurchaseDetailFindAllService extends PurchaseDetailService
{
/*    public function executeCollection(array $query): array {
        try {

            $findPurchaseAll = $this->purchaseDetailRepository->allPurchasesDetails($query);
            $listUser = [];
            foreach ($findPurchaseAll as $purchase) {
                $listUser[] = $this->purchaseDetailMapper->autoMapper->map($purchase, PurchaseDetailDto::class);
            }
            return $listUser;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }*/

    public function executeCollectionDetail(string $iRef, array $query): array {
        try {

            $findPurchaseId = $this->findResourceByUuid(new PurchaseModel(), $iRef);

            $findPurchaseAll = $this->purchaseDetailRepository->allPurchasesDetails($findPurchaseId, $query);

            $listUser = [];
            foreach ($findPurchaseAll as $purchase) {
                $listUser[] = $this->purchaseDetailMapper->autoMapper->map($purchase, PurchaseDetailDto::class);
            }
            return $listUser;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}