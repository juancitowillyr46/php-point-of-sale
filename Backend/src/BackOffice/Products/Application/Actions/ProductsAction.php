<?php
namespace App\BackOffice\Products\Application\Actions;

use App\BackOffice\Products\Domain\Exceptions\ProductActionRequestSchema;
use App\BackOffice\Products\Domain\Services\Productservice;
use Psr\Log\LoggerInterface;

class ProductsAction
{
    public ProductActionRequestSchema $validateSchema;
    public ProductService $service;
    public LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, ProductActionRequestSchema $validateSchema, ProductService $service)
    {
        $this->validateSchema = $validateSchema;
        $this->service = $service;
        $this->logger = $logger;
    }
}

