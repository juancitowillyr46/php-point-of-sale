<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseDto;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use Exception;

class PurchaseFindService extends PurchaseService
{
    public function executeArg(string $uuid): object {
        try {

            $findResourceId = $this->findResourceByUuid(new PurchaseModel(), $uuid);
            $purchase = $this->purchaseRepository->findPurchase($findResourceId);
            $purchase['document_type_name'] = $this->findNameResourceByUIdRegister($purchase['document_type_id'], 'TABLE_DOCUMENT_TYPE_TAX');
            $purchase['document_type_id'] = $this->getUuidDataMaster($purchase['document_type_id'], 'TABLE_DOCUMENT_TYPE_TAX');
            $purchase['provider_name'] = $this->getAttributeById(new ProviderModel(), $purchase['provider_id'], 'name');
            $purchase['provider_id'] = $this->getAttributeById(new ProviderModel(), $purchase['provider_id'], 'uuid');
            return $this->purchaseMapper->autoMapper->map($purchase, PurchaseDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}