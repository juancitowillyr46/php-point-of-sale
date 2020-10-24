<?php


namespace App\BackOffice\Sales\Domain\Services\Detail;


use App\BackOffice\Sales\Domain\Entities\Detail\SaleDetailModel;
use App\BackOffice\Sales\Domain\Entities\SaleModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class SaleDetailRemoveService extends SaleDetailService
{
    public function executeArgs(string $saleDetailId, string $saleId): object {
        try {

            $this->findResourceByUuid(new SaleModel(), $saleId);

            $findUser = $this->findResourceByUuid(new SaleDetailModel(), $saleDetailId);
            $success = $this->saleDetailRepository->removeSaleDetail((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->saleDetailEntity->setUuid($saleDetailId);
            return $this->saleDetailEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}