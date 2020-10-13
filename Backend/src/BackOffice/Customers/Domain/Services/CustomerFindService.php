<?php
namespace App\BackOffice\Customers\Domain\Services;

use App\BackOffice\Customers\Domain\Entities\CustomerDto;
use App\BackOffice\Customers\Domain\Entities\CustomerModel;
use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use Exception;

class CustomerFindService extends CustomerService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new CustomerModel(), $uuid);

            $customer = $this->customerRepository->findCustomer($findResourceId);

            $departmentUuid = $this->getAttributeById(new UbigeoModel(), $customer['department_id'], 'uuid');
            $provinceUuid = $this->getAttributeById(new UbigeoModel(), $customer['province_id'], 'uuid');
            $districtUuid = $this->getAttributeById(new UbigeoModel(), $customer['district_id'], 'uuid');

            $documentTypeName = $this->findNameResourceByUIdRegister($customer['document_type_id'], 'TABLE_DOCUMENT_TYPE');
            $customer['document_type_name'] = $documentTypeName;

            $documentTypeId = $this->getUuidDataMaster($customer['document_type_id'], 'TABLE_DOCUMENT_TYPE');
            $customer['document_type_id'] = $documentTypeId;

            $customer['department_id'] = $departmentUuid;
            $customer['province_id'] = $provinceUuid;
            $customer['district_id'] = $districtUuid;

            $departmentName = $this->getAttributeByUuid(new UbigeoModel(), $departmentUuid, 'name');
            $provinceName = $this->getAttributeByUuid(new UbigeoModel(), $provinceUuid, 'name');
            $districtName = $this->getAttributeByUuid(new UbigeoModel(), $districtUuid, 'name');

            $customer['department_name'] = $departmentName;
            $customer['province_name'] = $provinceName;
            $customer['district_name'] = $districtName;

            return $this->customerMapper->autoMapper->map($customer, CustomerDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}