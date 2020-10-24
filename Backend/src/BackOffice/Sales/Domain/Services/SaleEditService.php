<?php
namespace App\BackOffice\Sales\Domain\Services;

use App\BackOffice\Employees\Domain\Entities\EmployeeModel;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Sales\Domain\Entities\SaleModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class SaleEditService extends Saleservice
{
    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $saleId = $this->findResourceByUuid(new SaleModel(), $uuid);

            $this->executePayLoad($bodyParsed);

            $success = $this->saleRepository->editSale($saleId, ((array) $this->saleEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->saleEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}