<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Ubigeo\Domain\Entities\UbigeoModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class ProviderEditService extends ProviderService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findProvider = $this->findResourceByUuid(new ProviderModel(), $uuid);

            $departmentId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->departmentId, 'id');
            $provinceId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->provinceId, 'id');
            $districtId = $this->getAttributeByUuid(new UbigeoModel(), $bodyParsed->districtId, 'id');

            $this->providerEntity->setDepartmentId($departmentId);
            $this->providerEntity->setProvinceId($provinceId);
            $this->providerEntity->setDistrictId($districtId);
            $this->providerEntity->payload($bodyParsed);

            $success = $this->providerRepository->editProvider($findProvider, ((array) $this->providerEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->providerEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}