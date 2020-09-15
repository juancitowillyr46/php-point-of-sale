<?php
namespace App\BackOffice\PurchasesDetail\Domain\Services;

use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class PurchaseDetailAddService extends PurchaseDetailService {

    public function executeWithIdRef(string $purchaseId, object $bodyParsed): object
    {
        try {

            $this->findCompareIdWithArg($purchaseId, $bodyParsed->purchaseId);

            $purchaseId = $this->findResourceByUuid(new PurchaseModel(), $purchaseId);

            $productId = $this->findResourceByUuid(new ProductModel(), $bodyParsed->productId);

            $this->purchaseDetailEntity->setBuyId($purchaseId);
            $this->purchaseDetailEntity->setProductId($productId);
            $this->purchaseDetailEntity->setPrice($bodyParsed->price);
            $this->purchaseDetailEntity->setQuantity($bodyParsed->quantity);
            $this->purchaseDetailEntity->payload($bodyParsed);

            $success = $this->purchaseDetailRepository->addPurchaseDetail(((array) $this->purchaseDetailEntity));

            if(!$success) {
                throw new AddActionException();
            }

            return $this->purchaseDetailEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}