<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\UsersType\Domain\Entities\UserTypeModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class ProviderEditService extends ProviderService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findProvider = $this->findResourceByUuid(new UserTypeModel(), $uuid);

            $this->ProviderEntity->payload($bodyParsed);
            $success = $this->ProviderRepository->editProvider($findProvider, ((array) $this->ProviderEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->ProviderEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}