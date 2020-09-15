<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\Employees\Domain\Entities\EmployeeModel;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseEntity;
use App\BackOffice\Purchases\Domain\Entities\PurchaseMapper;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\BackOffice\Purchases\Infrastructure\Persistence\PurchaseRepository;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailAddService;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class PurchaseAddService extends PurchaseService
{
    public function __construct(PurchaseRepository $purchaseRepository, PurchaseEntity $purchaseEntity, PurchaseMapper $purchaseMapper)
    {
        parent::__construct($purchaseRepository, $purchaseEntity, $purchaseMapper);
    }

    public function execute(object $bodyParsed): object
    {
        try {

            $documentTypeId = $this->findResourceByUuidReturnIdRegister($bodyParsed->documentTypeId);
            $statusId = $this->findResourceByUuidReturnIdRegister($bodyParsed->documentTypeId);
            $providerId = $this->findResourceByUuid(new ProviderModel(), $bodyParsed->providerId);
            $employeeId = $this->findResourceByUuid(new EmployeeModel(), $bodyParsed->employeeId);

            $this->purchaseEntity->setDocumentTypeId($documentTypeId);
            $this->purchaseEntity->setStatusId($statusId);
            $this->purchaseEntity->setProviderId($providerId);
            $this->purchaseEntity->setEmployeeId($employeeId);
            $this->purchaseEntity->payload($bodyParsed);

            $success = $this->purchaseRepository->addPurchase(((array) $this->purchaseEntity));

            if(!$success) {
                throw new AddActionException();
            }

            return $this->purchaseEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}