<?php
namespace App\BackOffice\Products\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\Shared\Exception\Commands\AddActionException;
use Exception;

class ProductAddService extends ProductService
{
    public function execute(object $bodyParsed): object
    {
        try {

            $categoryId = $this->findResourceByUuid(new CategoryModel(), $bodyParsed->categoryId);
            $providerId = $this->findResourceByUuid(new ProviderModel(), $bodyParsed->providerId);
            $measureUnitId = $this->findResourceByUuidReturnIdRegister($bodyParsed->measureUnitId);

            $code = $this->getCode('PROD');

            $this->productEntity->setCode($code);
            $this->productEntity->setCategoryId($categoryId);
            $this->productEntity->setUnitMeasurentId($measureUnitId);
            $this->productEntity->setProviderId($providerId);
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