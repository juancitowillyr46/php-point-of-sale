<?php
namespace App\BackOffice\Sales\Domain\Services\Detail;

use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailEntity;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailMapper;
use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailModel;
use App\BackOffice\Sales\Infrastructure\Persistence\SaleDetailRepository;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class SaleDetailAddService extends SaleDetailService
{
    public function __construct(
        SaleDetailRepository $saleDetailRepository,
        SaleDetailEntity $saleDetailEntity,
        SaleDetailMapper $saleDetailMapper)
    {
        parent::__construct($saleDetailRepository, $saleDetailEntity, $saleDetailMapper);
    }

    public function executeArgWithBodyParsed(string $saleId, object $bodyParsed): object
    {
        try {

            $this->findCompareIdWithArg($saleId, $bodyParsed->saleId);

            $this->executePayLoad($bodyParsed);

            $success = $this->saleDetailRepository->addSaleDetail(((array) $this->saleDetailEntity));

            if(!$success) {
                throw new AddActionException();
            }

            return $this->saleDetailEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}