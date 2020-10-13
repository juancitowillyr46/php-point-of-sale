<?php
namespace App\BackOffice\Customers\Domain\Services;

use App\BackOffice\Customers\Domain\Entities\CustomerModel;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class CustomerEditService extends CustomerService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findCustomer = $this->findResourceByUuid(new CustomerModel(), $uuid);

            $departmentId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->departmentId, 'id');
            $provinceId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->provinceId, 'id');
            $districtId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->districtId, 'id');

            $documentTypeId = $this->findResourceByUuidReturnIdRegister($bodyParsed->documentTypeId);

            $this->customerEntity->setDocumentTypeId($documentTypeId);
            $this->customerEntity->setDepartmentId($departmentId);
            $this->customerEntity->setProvinceId($provinceId);
            $this->customerEntity->setDistrictId($districtId);
            $this->customerEntity->payload($bodyParsed);

            $success = $this->customerRepository->editCustomer($findCustomer, ((array) $this->customerEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->customerEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}