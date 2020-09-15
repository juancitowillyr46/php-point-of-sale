<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryDto;
use Exception;

class CategoryFindAllService extends CategoryService
{

    public function executeCollection(array $query): array {
        try {

            $findUserAll = $this->categoryRepository->allCategories($query);
            $listUser = [];
            foreach ($findUserAll as $userType) {
                $listUser[] = $this->categoryMapper->autoMapper->map($userType, CategoryDto::class);
            }
            return $listUser;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}