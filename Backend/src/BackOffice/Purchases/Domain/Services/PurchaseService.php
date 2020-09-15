<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\DataMaster\Domain\Services\DataMasterService;
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
}