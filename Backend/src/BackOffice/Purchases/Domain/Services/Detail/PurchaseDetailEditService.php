<?php


namespace App\BackOffice\Purchases\Domain\Services\Detail;


use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailEntity;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailMapper;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailModel;
use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\BackOffice\Purchases\Infrastructure\Persistence\PurchaseDetailRepository;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class PurchaseDetailEditService extends PurchaseDetailService
{
    public function __construct(
        PurchaseDetailRepository $purchaseDetailRepository,
        PurchaseDetailEntity $purchaseDetailEntity,
        PurchaseDetailMapper $purchaseDetailMapper)
    {
        parent::__construct($purchaseDetailRepository, $purchaseDetailEntity, $purchaseDetailMapper);
    }

    public function executeArgsWithBodyParsed(string $purchaseDetailUuid, string $purchaseUuid, object $bodyParsed): object
    {
        try {

            $this->findResourceByUuid(new PurchaseModel(), $bodyParsed->purchaseId);
            $this->findCompareIdWithArg($purchaseUuid, $bodyParsed->purchaseId);

            $this->findCompareIdWithArg($purchaseDetailUuid, $bodyParsed->id);

            $purchaseDetailId = $this->findResourceByUuid(new PurchaseDetailModel(), $purchaseDetailUuid);

            $this->executePayLoad($bodyParsed);

            $success = $this->purchaseDetailRepository->editPurchaseDetail($purchaseDetailId,(array) $this->purchaseDetailEntity);

            if(!$success) {
                throw new EditActionException();
            }

            return $this->purchaseDetailEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}