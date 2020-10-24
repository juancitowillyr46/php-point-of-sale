<?php
namespace App\BackOffice\Sales\Domain\Services;

use App\BackOffice\Customers\Domain\Entities\CustomerModel;
use App\BackOffice\Sales\Domain\Entities\SaleDto;
use App\BackOffice\Sales\Domain\Entities\SaleModel;
use Exception;

class SaleFindService extends Saleservice
{
    public function executeArg(string $uuid): object {
        try {

            $findResourceId = $this->findResourceByUuid(new SaleModel(), $uuid);
            $sale = $this->saleRepository->findSale($findResourceId);
            $sale['document_type_name'] = $this->findNameResourceByUIdRegister($sale['document_type_id'], 'TABLE_DOCUMENT_TYPE_TAX');
            $sale['document_type_id'] = $this->getUuidDataMaster($sale['document_type_id'], 'TABLE_DOCUMENT_TYPE_TAX');
            $sale['customer_name'] = $this->getAttributeById(new CustomerModel(), $sale['customer_id'], 'first_name');
            $sale['customer_id'] = $this->getAttributeById(new CustomerModel(), $sale['customer_id'], 'uuid');
            return $this->saleMapper->autoMapper->map($sale, SaleDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}