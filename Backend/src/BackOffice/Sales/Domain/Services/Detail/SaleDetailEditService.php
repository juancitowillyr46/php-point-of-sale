<?php


namespace App\BackOffice\Sales\Domain\Services\Detail;


use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailEntity;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailMapper;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailModel;
use App\BackOffice\Sales\Domain\Entities\SaleModel;
use App\BackOffice\Sales\Infrastructure\Persistence\SaleDetailRepository;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class SaleDetailEditService extends SaleDetailService
{
    public function __construct(
        SaleDetailRepository $saleDetailRepository,
        SaleDetailEntity $saleDetailEntity,
        SaleDetailMapper $saleDetailMapper)
    {
        parent::__construct($saleDetailRepository, $saleDetailEntity, $saleDetailMapper);
    }

    public function executeArgsWithBodyParsed(string $saleDetailUuid, string $saleUuid, object $bodyParsed): object
    {
        try {

            $this->findResourceByUuid(new SaleModel(), $bodyParsed->saleId);
            $this->findCompareIdWithArg($saleUuid, $bodyParsed->saleId);

            $this->findCompareIdWithArg($saleDetailUuid, $bodyParsed->id);

            $saleDetailId = $this->findResourceByUuid(new SaleDetailModel(), $saleDetailUuid);

            $this->executePayLoad($bodyParsed);

            $success = $this->saleDetailRepository->editSaleDetail($saleDetailId,(array) $this->saleDetailEntity);

            if(!$success) {
                throw new EditActionException();
            }

            return $this->saleDetailEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}