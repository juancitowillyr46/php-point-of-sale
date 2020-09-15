<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class CategoryRemoveService extends CategoryService
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new CategoryModel(), $uuid);
            $success = $this->categoryRepository->removeCategory((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->categoryEntity->setUuid($uuid);
            return $this->categoryEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}