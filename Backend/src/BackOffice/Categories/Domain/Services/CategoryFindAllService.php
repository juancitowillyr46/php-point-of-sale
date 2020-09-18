<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryDto;
use Exception;

class CategoryFindAllService extends CategoryService
{

    public function executeCollectionPagination(array $query): object {
        try {

            $findUserAll = $this->categoryRepository->allCategories($query);
            $listCategory = [];
            foreach ($findUserAll->registers as $userType) {
                $listCategory[] = $this->categoryMapper->autoMapper->map($userType, CategoryDto::class);
            }
            $findUserAll->registers = $listCategory;
            return $findUserAll;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}