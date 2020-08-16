<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use App\BackOffice\PurchasesDetail\Domain\Exceptions\PurchaseDetailActionRequestSchema;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailService;
use Psr\Log\LoggerInterface;

class PurchasesDetailAction
{
    public PurchaseDetailActionRequestSchema $validateSchema;
    public PurchaseDetailService $service;
    public LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, PurchaseDetailActionRequestSchema $validateSchema, PurchaseDetailService $service)
    {
        $this->validateSchema = $validateSchema;
        $this->service = $service;
        $this->logger = $logger;
    }
}

