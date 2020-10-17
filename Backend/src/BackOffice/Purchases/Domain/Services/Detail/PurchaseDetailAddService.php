<?php
namespace App\BackOffice\Purchases\Domain\Services\Detail;

use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailEntity;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailMapper;
use App\BackOffice\Purchases\Domain\Entities\Detail\PurchaseDetailModel;
use App\BackOffice\Purchases\Infrastructure\Persistence\PurchaseDetailRepository;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class PurchaseDetailAddService extends PurchaseDetailService
{
    public function __construct(
        PurchaseDetailRepository $purchaseDetailRepository,
        PurchaseDetailEntity $purchaseDetailEntity,
        PurchaseDetailMapper $purchaseDetailMapper)
    {
        parent::__construct($purchaseDetailRepository, $purchaseDetailEntity, $purchaseDetailMapper);
    }

    public function executeArgWithBodyParsed(string $purchaseId, object $bodyParsed): object
    {
        try {

            $this->findCompareIdWithArg($purchaseId, $bodyParsed->purchaseId);

            $this->executePayLoad($bodyParsed);

            $success = $this->purchaseDetailRepository->addPurchaseDetail(((array) $this->purchaseDetailEntity));

            if(!$success) {
                throw new AddActionException();
            }

            return $this->purchaseDetailEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}