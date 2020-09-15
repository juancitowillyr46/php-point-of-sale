<?php
namespace App\BackOffice\PurchasesDetail\Domain\Services;

use App\BackOffice\DataMaster\Domain\Services\DataMasterService;
use App\BackOffice\Products\Domain\Services\ProductService;
use App\BackOffice\Purchases\Domain\Entities\PurchaseEntity;
use App\BackOffice\Purchases\Domain\Services\PurchaseService;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailEntity;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailDto;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailMapper;
use App\BackOffice\PurchasesDetail\Infrastructure\Persistence\PurchaseDetailRepository;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\Commands\FindActionException;
use App\Shared\Exception\Commands\FindAllActionException;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;
use stdClass;

class PurchaseDetailService extends BaseService
{
    protected PurchaseDetailEntity $purchaseDetailEntity;
    protected PurchaseDetailRepository $purchaseDetailRepository;
    protected PurchaseDetailMapper $purchaseDetailMapper;

    public function __construct(PurchaseDetailRepository $purchaseDetailRepository, PurchaseDetailEntity $purchaseDetailEntity, PurchaseDetailMapper $purchaseDetailMapper)
    {
        $this->purchaseDetailRepository = $purchaseDetailRepository;
        $this->purchaseDetailEntity = $purchaseDetailEntity;
        $this->purchaseDetailMapper = $purchaseDetailMapper;
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