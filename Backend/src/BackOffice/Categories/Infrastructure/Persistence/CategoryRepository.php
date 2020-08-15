<?php
namespace App\BackOffice\Categories\Infrastructure\Persistence;

use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\Shared\Infrastructure\Persistence\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function __construct(CategoryModel $model)
    {
        $this->setModel($model);
    }

}