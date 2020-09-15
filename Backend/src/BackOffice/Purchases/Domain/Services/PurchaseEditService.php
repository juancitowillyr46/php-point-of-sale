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

            $findPurchase = $this->findResourceByUuid(new PurchaseModel(), $uuid);

            $documentTypeId = $this->findResourceByUuidReturnIdRegister($bodyParsed->documentTypeId);
            $statusId = $this->findResourceByUuidReturnIdRegister($bodyParsed->documentTypeId);
            $providerId = $this->findResourceByUuid(new ProviderModel(), $bodyParsed->providerId);
            $employeeId = $this->findResourceByUuid(new EmployeeModel(), $bodyParsed->employeeId);

            $this->purchaseEntity->setDocumentTypeId($documentTypeId);
            $this->purchaseEntity->setStatusId($statusId);
            $this->purchaseEntity->setProviderId($providerId);
            $this->purchaseEntity->setEmployeeId($employeeId);
            $this->purchaseEntity->payload($bodyParsed);

            $success = $this->purchaseRepository->editPurchase($findPurchase, ((array) $this->purchaseEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->purchaseEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}