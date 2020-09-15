<?php
namespace App\BackOffice\Products\Application\Actions;

use App\BackOffice\Products\Domain\Exceptions\ProductActionRequestSchema;
use App\BackOffice\Products\Domain\Services\ProductAddService;
use App\BackOffice\Products\Domain\Services\ProductEditService;
use App\BackOffice\Products\Domain\Services\ProductFindAllService;
use App\BackOffice\Products\Domain\Services\ProductFindService;
use App\BackOffice\Products\Domain\Services\ProductRemoveService;
use App\BackOffice\Products\Domain\Services\Productservice;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class ProductsAction extends Action
{
    public ProductAddService $productAddService;
    public ProductEditService $productEditService;
    public ProductFindService $productFindService;
    public ProductFindAllService $productFindAllService;
    public ProductRemoveService $productRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        ProductAddService $productAddService,
        ProductEditService $productEditService,
        ProductFindService $productFindService,
        ProductFindAllService $productFindAllService,
        ProductRemoveService $productRemoveService
    )
    {
        $this->productAddService = $productAddService;
        $this->productEditService = $productEditService;
        $this->productFindService = $productFindService;
        $this->productFindAllService = $productFindAllService;
        $this->productRemoveService = $productRemoveService;
        parent::__construct($logger);
    }
}

