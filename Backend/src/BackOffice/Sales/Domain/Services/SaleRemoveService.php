<?php
namespace App\BackOffice\Sales\Domain\Services;

use App\BackOffice\Sales\Domain\Entities\SaleModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class SaleRemoveService extends Saleservice
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new SaleModel(), $uuid);
            $success = $this->saleRepository->removeSale((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->saleEntity->setUuid($uuid);
            return $this->saleEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}