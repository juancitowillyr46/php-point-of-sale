<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryDto;
use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use Exception;

class CategoryFindService extends CategoryService
{
    public function executeArg(string $uuid): object {

        try {

            $findResourceId = $this->findResourceByUuid(new CategoryModel(), $uuid);
            $findUser = $this->categoryRepository->findCategory($findResourceId);
            return $this->categoryMapper->autoMapper->map($findUser, CategoryDto::class);

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}