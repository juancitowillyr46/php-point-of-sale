<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseDto;
use Exception;

class PurchaseFindAllService extends PurchaseService
{
    public function executeCollectionPagination(array $query): object {
        try {

            $findPurchaseAll = $this->purchaseRepository->allPurchases($query);
            $listPurchase = [];
            foreach ($findPurchaseAll->rows as $purchase) {

                $purchase['document_type_name'] = $this->findNameResourceByUIdRegister($purchase['document_type_id'], 'TABLE_DOCUMENT_TYPE_TAX');
                $purchase['document_type_id'] = $this->getUuidDataMaster($purchase['document_type_id'], 'TABLE_DOCUMENT_TYPE_TAX');
                $purchase['provider_name'] = $this->getAttributeById(new ProviderModel(), $purchase['provider_id'], 'name');
                $purchase['provider_id'] = $this->getAttributeById(new ProviderModel(), $purchase['provider_id'], 'uuid');

                $listPurchase[] = $this->purchaseMapper->autoMapper->map($purchase, PurchaseDto::class);
            }

            $findPurchaseAll->rows = $listPurchase;
            return $findPurchaseAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}