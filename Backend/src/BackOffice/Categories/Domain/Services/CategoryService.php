<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryEntity;
use App\BackOffice\Categories\Domain\Entities\CategoryMapper;
use App\BackOffice\Categories\Infrastructure\Persistence\CategoryRepository;
use App\Shared\Domain\Entities\CommonMapper;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class CategoryService extends BaseService
{

    protected CategoryEntity $categoryEntity;
    protected CategoryRepository $categoryRepository;
    protected CategoryMapper $categoryMapper;
    protected CommonMapper $commonMapper;

    public function __construct(CategoryRepository $categoryRepository, CategoryEntity $categoryEntity, CategoryMapper $categoryMapper, CommonMapper $commonMapper)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryEntity = $categoryEntity;
        $this->categoryMapper = $categoryMapper;
        $this->commonMapper = $commonMapper;
    }

    public function execute(object $bodyParsed): object
    {
        return new stdClass();
    }

    public function executeArg(string $uuid): object
    {
        return new stdClass();
    }

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object
    {
        return new stdClass();
    }

    public function executeCollection(array $query): array
    {
        return [];
    }
}