<?php
namespace App\BackOffice\Customers\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class CustomerAddService extends CustomerService
{

    public function execute(object $bodyParsed): object
    {
        try {

            $departmentId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->departmentId, 'id');
            $provinceId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->provinceId, 'id');
            $districtId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->districtId, 'id');

            $documentTypeId = $this->findResourceByUuidReturnIdRegister($bodyParsed->documentTypeId);

            $this->customerEntity->setDocumentTypeId($documentTypeId);
            $this->customerEntity->setDepartmentId($departmentId);
            $this->customerEntity->setProvinceId($provinceId);
            $this->customerEntity->setDistrictId($districtId);
            $this->customerEntity->payload($bodyParsed);

            $success = $this->customerRepository->addCustomer(((array) $this->customerEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->customerEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}