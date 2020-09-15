<?php
namespace App\BackOffice\Products\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\MeasureUnits\Domain\Entities\MeasureUnitModel;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class ProductAddService extends ProductService
{
    public function execute(object $bodyParsed): object
    {
        try {

            $idCategory = $this->findResourceByUuid(new CategoryModel(), $bodyParsed->categoryId);
//            $idMeasureUnit = $this->findResourceByUuid(new DataMasterModel(), $bodyParsed->measureUnitId);
            $idMeasureUnit = $this->findResourceByUuidReturnIdRegister($bodyParsed->measureUnitId);
            $this->productEntity->setIdCategory($idCategory);
            $this->productEntity->setIdUnitMeasurent($idMeasureUnit);
            $this->productEntity->payload($bodyParsed);
            $success = $this->productRepository->addProduct(((array) $this->productEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->productEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}