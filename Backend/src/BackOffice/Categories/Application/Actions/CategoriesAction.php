<?php
namespace App\BackOffice\Categories\Application\Actions;

use App\BackOffice\Categories\Domain\Exceptions\CategoryActionRequestSchema;
use App\BackOffice\Categories\Domain\Services\CategoryService;
use Psr\Log\LoggerInterface;

class CategoriesAction
{
    public CategoryActionRequestSchema $validateSchema;
    public CategoryService $service;
    public LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, CategoryActionRequestSchema $validateSchema, CategoryService $service)
    {
        $this->validateSchema = $validateSchema;
        $this->service = $service;
        $this->logger = $logger;
    }
}

