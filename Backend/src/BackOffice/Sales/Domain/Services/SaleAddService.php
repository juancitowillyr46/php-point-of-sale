<?php
namespace App\BackOffice\Sales\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\Sales\Domain\Entities\SaleEntity;
use App\BackOffice\Sales\Domain\Entities\SaleMapper;
use App\BackOffice\Sales\Domain\Entities\SaleModel;
use App\BackOffice\Sales\Infrastructure\Persistence\SaleRepository;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class SaleAddService extends Saleservice
{
    public function __construct(SaleRepository $saleRepository, SaleEntity $saleEntity, SaleMapper $saleMapper)
    {
        parent::__construct($saleRepository, $saleEntity, $saleMapper);
    }

    public function execute(object $bodyParsed): object
    {
        try {

            $this->executePayLoad($bodyParsed);

            $success = $this->saleRepository->addSale(((array) $this->saleEntity));

            if(!$success) {
                throw new AddActionException();
            }

            return $this->saleEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}