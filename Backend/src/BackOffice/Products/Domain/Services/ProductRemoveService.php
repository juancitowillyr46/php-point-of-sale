<?php
namespace App\BackOffice\Products\Domain\Services;

use App\BackOffice\Products\Domain\Entities\ProductModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class ProductRemoveService extends ProductService
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new ProductModel(), $uuid);
            $success = $this->productRepository->removeProduct((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->productEntity->setUuid($uuid);
            return $this->productEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}