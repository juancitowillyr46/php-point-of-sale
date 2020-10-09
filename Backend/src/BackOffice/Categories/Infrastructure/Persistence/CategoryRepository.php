<?php
namespace App\BackOffice\Categories\Infrastructure\Persistence;

use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\BackOffice\Categories\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public CategoryModel $categoryModel;

    public function __construct(CategoryModel $categoryModel)
    {
        $this->categoryModel = $categoryModel;
        $this->setModel($categoryModel);
    }

    public function addCategory(array $category): bool
    {
        try {
            $addCategory = $this->categoryModel::create($category);
            return $addCategory->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editCategory(int $id, array $userType): bool
    {
        try {
            $editCategory = $this->categoryModel::all()->find($id);
            return $editCategory->update($userType);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findCategory(int $id): array
    {
        $findCategory = $this->categoryModel::all()->find($id);
        return $findCategory->toArray();
    }

    public function removeCategory(int $id): bool
    {
        try {
            $editCategory = $this->categoryModel::all()->find($id);
            $editCategory->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editCategory->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allCategories(array $query): object
    {
        return $this->paginateModel($query, $this->categoryModel);
    }

    public function commonCategory(): array
    {
        try {

            return $this->categoryModel::all()
                ->where('active', '=', true)
                ->toArray();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}