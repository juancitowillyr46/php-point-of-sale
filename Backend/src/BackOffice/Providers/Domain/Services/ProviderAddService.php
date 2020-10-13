<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class ProviderAddService extends ProviderService
{

    public function execute(object $bodyParsed): object
    {
        try {

            $departmentId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->departmentId, 'id');
            $provinceId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->provinceId, 'id');
            $districtId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->districtId, 'id');

            $this->providerEntity->setDepartmentId($departmentId);
            $this->providerEntity->setProvinceId($provinceId);
            $this->providerEntity->setDistrictId($districtId);
            $this->providerEntity->payload($bodyParsed);

            $success = $this->providerRepository->addProvider(((array) $this->providerEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->providerEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}