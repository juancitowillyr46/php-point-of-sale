<?php
namespace App\BackOffice\Purchases\Application\Actions;

use App\BackOffice\Purchases\Domain\Services\PurchaseAddService;
use App\BackOffice\Purchases\Domain\Services\PurchaseEditService;
use App\BackOffice\Purchases\Domain\Services\PurchaseFindAllService;
use App\BackOffice\Purchases\Domain\Services\PurchaseFindService;
use App\BackOffice\Purchases\Domain\Services\PurchaseRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class PurchasesAction extends Action
{
    public PurchaseAddService $purchaseAddService;
    public PurchaseEditService $purchaseEditService;
    public PurchaseFindService $purchaseFindService;
    public PurchaseFindAllService $purchaseFindAllService;
    public PurchaseRemoveService $purchaseRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        PurchaseAddService $purchaseAddService,
        PurchaseEditService $purchaseEditService,
        PurchaseFindService $purchaseFindService,
        PurchaseFindAllService $purchaseFindAllService,
        PurchaseRemoveService $purchaseRemoveService
    )
    {
        $this->purchaseAddService = $purchaseAddService;
        $this->purchaseEditService = $purchaseEditService;
        $this->purchaseFindService = $purchaseFindService;
        $this->purchaseFindAllService = $purchaseFindAllService;
        $this->purchaseRemoveService = $purchaseRemoveService;
        parent::__construct($logger);
    }
}

