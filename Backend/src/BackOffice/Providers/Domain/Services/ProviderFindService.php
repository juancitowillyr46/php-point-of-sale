<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderDto;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use Exception;

class ProviderFindService extends ProviderService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new ProviderModel(), $uuid);
            $findUser = $this->ProviderRepository->findProvider($findResourceId);
            return $this->ProviderMapper->autoMapper->map($findUser, ProviderDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}