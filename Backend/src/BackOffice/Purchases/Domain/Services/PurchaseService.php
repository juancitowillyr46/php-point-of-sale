<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\DataMaster\Domain\Services\DataMasterService;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseEntity;
use App\BackOffice\Purchases\Domain\Entities\PurchaseDto;
use App\BackOffice\Purchases\Domain\Entities\PurchaseMapper;
use App\BackOffice\Purchases\Infrastructure\Persistence\PurchaseRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;
use stdClass;

class PurchaseService extends BaseService
{
    protected PurchaseEntity $purchaseEntity;
    protected PurchaseRepository $purchaseRepository;
    protected PurchaseMapper $purchaseMapper;

    public function __construct(PurchaseRepository $purchaseRepository, PurchaseEntity $purchaseEntity, PurchaseMapper $purchaseMapper)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->purchaseEntity = $purchaseEntity;
        $this->purchaseMapper = $purchaseMapper;
    }

    public function execute(object $bodyParsed): object
    {
        return new stdClass();
    }

    public function executeArg(string $uuid): object
    {
        return new stdClass();
    }

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object
    {
        return new stdClass();
    }

    public function executeCollection(array $query): array
    {
        return [];
    }

    public function executePayLoad(object $bodyParsed): void {

        try {

            $this->purchaseEntity->validateBodyParsed($bodyParsed);
            $this->purchaseEntity->identifiedResource($bodyParsed);

            $this->purchaseEntity->setProviderId($this->findResourceByUuid(new ProviderModel(), $bodyParsed->providerId));
            $this->purchaseEntity->setDocumentTypeId($this->findResourceByUuidReturnIdRegister($bodyParsed->documentTypeId));
            $this->purchaseEntity->setDocumentNumber($bodyParsed->documentNumber);

            $time = strtotime($bodyParsed->date . '00:00:00');
            $this->purchaseEntity->setDate(date('Y-m-d H:i:s', $time));

//            $this->purchaseEntity->setDate($bodyParsed->date);
            $this->purchaseEntity->setTotal($bodyParsed->total);
            $this->purchaseEntity->setTax(0);
            $this->purchaseEntity->setNote($bodyParsed->note);
            $this->purchaseEntity->setActive($bodyParsed->active);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}