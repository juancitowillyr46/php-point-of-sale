<?php


namespace App\BackOffice\Products\Domain\Services;


use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class ProductEditService extends ProductService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findProduct = $this->findResourceByUuid(new ProductModel(), $uuid);

            $idCategory = $this->findResourceByUuid(new CategoryModel(), $bodyParsed->categoryId);

            $idMeasureUnit = $this->findResourceByUuidReturnIdRegister($bodyParsed->measureUnitId);
//            $idMeasureUnit = $this->findResourceByUuid(new DataMasterModel(), $bodyParsed->measureUnitId);

            $this->productEntity->setIdCategory($idCategory);
            $this->productEntity->setIdUnitMeasurent($idMeasureUnit);
            $this->productEntity->payload($bodyParsed);

            $success = $this->productRepository->editProduct($findProduct, ((array) $this->productEntity));

            if(!$success) {
                throw new EditActionException();
            }

            return $this->productEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}