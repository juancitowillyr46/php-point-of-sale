<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderDto;
use Exception;

class ProviderFindAllService extends ProviderService
{

    public function executeCollection(array $query): array {
        try {

            $findUserAll = $this->ProviderRepository->allProviders($query);
            $listUser = [];
            foreach ($findUserAll as $userType) {
                $listUser[] = $this->ProviderMapper->autoMapper->map($userType, ProviderDto::class);
            }
            return $listUser;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}