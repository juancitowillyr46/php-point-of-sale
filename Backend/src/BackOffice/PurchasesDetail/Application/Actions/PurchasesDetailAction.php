<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use App\BackOffice\PurchasesDetail\Domain\Exceptions\PurchaseDetailValidateSchema;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailAddService;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailEditService;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailFindAllService;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailFindService;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailRemoveService;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class PurchasesDetailAction extends Action
{
    public PurchaseDetailAddService $purchaseDetailAddService;
    public PurchaseDetailEditService $purchaseDetailEditService;
    public PurchaseDetailFindService $purchaseDetailFindService;
    public PurchaseDetailFindAllService $purchaseDetailFindAllService;
    public PurchaseDetailRemoveService $purchaseDetailRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        PurchaseDetailAddService $purchaseDetailAddService,
        PurchaseDetailEditService $purchaseDetailEditService,
        PurchaseDetailFindService $purchaseDetailFindService,
        PurchaseDetailFindAllService $purchaseDetailFindAllService,
        PurchaseDetailRemoveService $purchaseDetailRemoveService
    )
    {
        $this->purchaseDetailAddService = $purchaseDetailAddService;
        $this->purchaseDetailEditService = $purchaseDetailEditService;
        $this->purchaseDetailFindService = $purchaseDetailFindService;
        $this->purchaseDetailFindAllService = $purchaseDetailFindAllService;
        $this->purchaseDetailRemoveService = $purchaseDetailRemoveService;
        parent::__construct($logger);
    }
}

