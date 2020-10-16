<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\Employees\Domain\Entities\EmployeeModel;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class PurchaseEditService extends PurchaseService
{
    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $purchaseId = $this->findResourceByUuid(new PurchaseModel(), $uuid);

            $this->executePayLoad($bodyParsed);

            $success = $this->purchaseRepository->editPurchase($purchaseId, ((array) $this->purchaseEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->purchaseEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}