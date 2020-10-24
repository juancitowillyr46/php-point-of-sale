<?php
namespace App\BackOffice\Sales\Domain\Services;

use App\BackOffice\Customers\Domain\Entities\CustomerModel;
use App\BackOffice\Sales\Domain\Entities\SaleDto;
use Exception;

class SaleFindAllService extends Saleservice
{
    public function executeCollectionPagination(array $query): object {
        try {

            $findPurchaseAll = $this->saleRepository->allPurchases($query);
            $listPurchase = [];
            foreach ($findPurchaseAll->rows as $sale) {

                $sale['document_type_name'] = $this->findNameResourceByUIdRegister($sale['document_type_id'], 'TABLE_DOCUMENT_TYPE_TAX');
                $sale['document_type_id'] = $this->getUuidDataMaster($sale['document_type_id'], 'TABLE_DOCUMENT_TYPE_TAX');
                $sale['customer_name'] = $this->getAttributeById(new CustomerModel(), $sale['customer_id'], 'first_name');
                $sale['customer_id'] = $this->getAttributeById(new CustomerModel(), $sale['customer_id'], 'uuid');

                $listPurchase[] = $this->saleMapper->autoMapper->map($sale, SaleDto::class);
            }

            $findPurchaseAll->rows = $listPurchase;
            return $findPurchaseAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}