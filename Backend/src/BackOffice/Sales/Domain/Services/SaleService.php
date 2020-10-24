<?php
namespace App\BackOffice\Sales\Domain\Services;

use App\BackOffice\Customers\Domain\Entities\CustomerModel;
use App\BackOffice\DataMaster\Domain\Services\DataMasterService;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Sales\Domain\Entities\SaleEntity;
use App\BackOffice\Sales\Domain\Entities\SaleDto;
use App\BackOffice\Sales\Domain\Entities\SaleMapper;
use App\BackOffice\Sales\Infrastructure\Persistence\SaleRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;
use stdClass;

class SaleService extends BaseService
{
    protected SaleEntity $saleEntity;
    protected SaleRepository $saleRepository;
    protected SaleMapper $saleMapper;

    public function __construct(SaleRepository $saleRepository, SaleEntity $saleEntity, SaleMapper $saleMapper)
    {
        $this->saleRepository = $saleRepository;
        $this->saleEntity = $saleEntity;
        $this->saleMapper = $saleMapper;
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

            $this->saleEntity->validateBodyParsed($bodyParsed);
            $this->saleEntity->identifiedResource($bodyParsed);

            $this->saleEntity->setCustomerId($this->findResourceByUuid(new CustomerModel(), $bodyParsed->customerId));
            $this->saleEntity->setDocumentTypeId($this->findResourceByUuidReturnIdRegister($bodyParsed->documentTypeId));
            $this->saleEntity->setDocumentNumber($bodyParsed->documentNumber);

            $time = strtotime($bodyParsed->date . '23:59:59');
            $this->saleEntity->setDate(date('Y-m-d', $time));

//            $this->saleEntity->setDate($bodyParsed->date);
            $this->saleEntity->setTotal($bodyParsed->total);
            $this->saleEntity->setTax(0);
            $this->saleEntity->setNote($bodyParsed->note);
            $this->saleEntity->setActive($bodyParsed->active);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}