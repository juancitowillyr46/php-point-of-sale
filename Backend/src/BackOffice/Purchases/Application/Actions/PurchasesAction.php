<?php
namespace App\BackOffice\Purchases\Application\Actions;

use App\BackOffice\Purchases\Domain\Exceptions\PurchaseActionRequestSchema;
use App\BackOffice\Purchases\Domain\Services\PurchaseService;
use Psr\Log\LoggerInterface;

class PurchasesAction
{
    public PurchaseActionRequestSchema $validateSchema;
    public PurchaseService $service;
    public LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, PurchaseActionRequestSchema $validateSchema, PurchaseService $service)
    {
        $this->validateSchema = $validateSchema;
        $this->service = $service;
        $this->logger = $logger;
    }
}

