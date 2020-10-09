<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryDto;
use App\Shared\Domain\Entities\CommonDto;
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

    public function executeCommon(): array
    {
        try {

            $findRoleAll = $this->categoryRepository->commonCategory();
            $listRole = [];
            foreach ($findRoleAll as $role) {
                $listRole[] = $this->commonMapper->autoMapper->map($role, CommonDto::class);
            }

            return $listRole;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}