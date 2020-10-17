<?php


namespace App\BackOffice\Purchases\Domain\Services\Detail;


use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailEntity;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailMapper;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\BackOffice\Purchases\Infrastructure\Persistence\PurchaseDetailRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
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

    function execute(object $bodyParsed): object
    {
        return new stdClass();
    }

    function executeArg(string $uuid): object
    {
        return new stdClass();
    }

    function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object
    {
        return new stdClass();
    }

    function executeCollection(array $query): array
    {
        return [];
    }

    public function executePayLoad(object $bodyParsed): void {

        try {

            $this->purchaseDetailEntity->validateBodyParsed($bodyParsed);
            $this->purchaseDetailEntity->identifiedResource($bodyParsed);
            $this->purchaseDetailEntity->setPurchaseId($this->findResourceByUuid(new PurchaseModel(), $bodyParsed->purchaseId));
            $this->purchaseDetailEntity->setProductId($this->findResourceByUuid(new ProductModel(), $bodyParsed->productId));
            $this->purchaseDetailEntity->setQuantity($bodyParsed->quantity);
            $this->purchaseDetailEntity->setPrice($bodyParsed->price);
            $this->purchaseDetailEntity->setSubtotal($bodyParsed->subtotal);
            $this->purchaseDetailEntity->setActive($bodyParsed->active);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}