<?php
namespace App\BackOffice\Categories\Application\Actions;

use App\BackOffice\Categories\Domain\Services\CategoryAddService;
use App\BackOffice\Categories\Domain\Services\CategoryEditService;
use App\BackOffice\Categories\Domain\Services\CategoryFindAllService;
use App\BackOffice\Categories\Domain\Services\CategoryFindService;
use App\BackOffice\Categories\Domain\Services\CategoryRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class CategoriesAction extends Action
{
    public CategoryAddService $categoryAddService;
    public CategoryEditService $categoryEditService;
    public CategoryFindService $categoryFindService;
    public CategoryFindAllService $categoryFindAllService;
    public CategoryRemoveService $categoryRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        CategoryAddService $categoryAddService,
        CategoryEditService $categoryEditService,
        CategoryFindService $categoryFindService,
        CategoryFindAllService $categoryFindAllService,
        CategoryRemoveService $categoryRemoveService
    )
    {
        $this->categoryAddService = $categoryAddService;
        $this->categoryEditService = $categoryEditService;
        $this->categoryFindService = $categoryFindService;
        $this->categoryFindAllService = $categoryFindAllService;
        $this->categoryRemoveService = $categoryRemoveService;
        parent::__construct($logger);
    }
}

