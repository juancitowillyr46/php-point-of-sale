<?php
namespace App\BackOffice\Products\Domain\Services;

use App\BackOffice\Products\Domain\Entities\ProductEntity;
use App\BackOffice\Products\Domain\Entities\ProductMapper;
use App\BackOffice\Products\Infrastructure\Persistence\ProductRepository;
use App\Shared\Domain\Entities\CommonMapper;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class ProductService extends BaseService
{
    protected ProductEntity $productEntity;
    protected ProductRepository $productRepository;
    protected ProductMapper $productMapper;
    protected CommonMapper $commonMapper;

    public function __construct(ProductRepository $productRepository, ProductEntity $productEntity, ProductMapper $productMapper, CommonMapper $commonMapper)
    {
        $this->productRepository = $productRepository;
        $this->productEntity = $productEntity;
        $this->productMapper = $productMapper;
        $this->commonMapper = $commonMapper;
    }

    function execute(object $bodyParsed): object
    {
        return new stdClass();
    }

    function executeArg(string $uuid): object
    {
        return new stdClass();
    }

    function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object
    {
        return new stdClass();
    }

    function executeCollection(array $query): array
    {
        return [];
    }

    function getCode($prefix = ''): string {
        $lastRecord = $this->productRepository->countProducts();
        return $prefix.$lastRecord;
    }
}