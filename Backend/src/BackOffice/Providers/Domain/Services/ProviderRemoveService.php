<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class ProviderRemoveService extends ProviderService
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new ProviderModel(), $uuid);
            $success = $this->providerRepository->removeProvider((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->providerEntity->setUuid($uuid);
            return $this->providerEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}