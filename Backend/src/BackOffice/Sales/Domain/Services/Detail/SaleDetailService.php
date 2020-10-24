<?php


namespace App\BackOffice\Sales\Domain\Services\Detail;


use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailEntity;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailMapper;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailModel;
use App\BackOffice\Sales\Domain\Entities\SaleModel;
use App\BackOffice\Sales\Infrastructure\Persistence\SaleDetailRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
use stdClass;

class SaleDetailService extends BaseService
{
    protected SaleDetailEntity $saleDetailEntity;
    protected SaleDetailRepository $saleDetailRepository;
    protected SaleDetailMapper $saleDetailMapper;

    public function __construct(SaleDetailRepository $saleDetailRepository, SaleDetailEntity $saleDetailEntity, SaleDetailMapper $saleDetailMapper)
    {
        $this->saleDetailRepository = $saleDetailRepository;
        $this->saleDetailEntity = $saleDetailEntity;
        $this->saleDetailMapper = $saleDetailMapper;
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

            $this->saleDetailEntity->validateBodyParsed($bodyParsed);
            $this->saleDetailEntity->identifiedResource($bodyParsed);
            $this->saleDetailEntity->setSaleId($this->findResourceByUuid(new SaleModel(), $bodyParsed->saleId));
            $this->saleDetailEntity->setProductId($this->findResourceByUuid(new ProductModel(), $bodyParsed->productId));
            $this->saleDetailEntity->setQuantity($bodyParsed->quantity);
            $this->saleDetailEntity->setPrice($bodyParsed->price);
            $this->saleDetailEntity->setSubtotal($bodyParsed->subtotal);
            $this->saleDetailEntity->setActive($bodyParsed->active);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}