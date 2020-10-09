<?php


namespace App\BackOffice\Products\Domain\Services;


use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class ProductEditService extends ProductService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findProduct = $this->findResourceByUuid(new ProductModel(), $uuid);

            $categoryIdEdit = $this->findResourceByUuid(new CategoryModel(), $bodyParsed->categoryId);
            $providerIdEdit = $this->findResourceByUuid(new ProviderModel(), $bodyParsed->providerId);
            $measureUnitIdEdit = $this->findResourceByUuidReturnIdRegister($bodyParsed->measureUnitId);

            $this->productEntity->setCategoryId($categoryIdEdit);
            $this->productEntity->setUnitMeasurentId($measureUnitIdEdit);
            $this->productEntity->setProviderId($providerIdEdit);
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