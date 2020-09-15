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
            $success = $this->ProviderRepository->removeProvider((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->ProviderEntity->setUuid($uuid);
            return $this->ProviderEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}