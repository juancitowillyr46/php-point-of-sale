<?php
namespace App\BackOffice\PurchasesDetail\Domain\Services;

use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class PurchaseDetailEditService extends PurchaseDetailService
{
    public function executeArgWithBodyParsedWithRef(string $purchaseIdRef, string $purchaseIdDetail, object $bodyParsedEdit): object {
        try {

            // Purchase
            $this->findCompareIdWithArg($purchaseIdRef, $bodyParsedEdit->purchaseId);
            $purchaseId = $this->findResourceByUuid(new PurchaseModel(), $bodyParsedEdit->purchaseId);

            // Product
            $productId = $this->findResourceByUuid(new ProductModel(), $bodyParsedEdit->productId);

            // Purchase Detail
            $this->findCompareIdWithArg($purchaseIdDetail, $bodyParsedEdit->id);
            $findPurchaseDetail = $this->findResourceByUuid(new PurchaseDetailModel(), $purchaseIdDetail);

            $this->purchaseDetailEntity->setBuyId($purchaseId);
            $this->purchaseDetailEntity->setProductId($productId);
            $this->purchaseDetailEntity->setPrice($bodyParsedEdit->price);
            $this->purchaseDetailEntity->setQuantity($bodyParsedEdit->quantity);
            $this->purchaseDetailEntity->payload($bodyParsedEdit);

            $success = $this->purchaseDetailRepository->editPurchaseDetail($findPurchaseDetail, ((array) $this->purchaseDetailEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->purchaseDetailEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}