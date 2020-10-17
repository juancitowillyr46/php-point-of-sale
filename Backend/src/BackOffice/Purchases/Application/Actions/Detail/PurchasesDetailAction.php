<?php
namespace App\BackOffice\Purchases\Application\Actions\Detail;

use App\BackOffice\Purchases\Domain\Services\Detail\PurchaseDetailAddService;
use App\BackOffice\Purchases\Domain\Services\Detail\PurchaseDetailEditService;
use App\BackOffice\Purchases\Domain\Services\Detail\PurchaseDetailFindAllService;
use App\BackOffice\Purchases\Domain\Services\Detail\PurchaseDetailFindService;
use App\BackOffice\Purchases\Domain\Services\Detail\PurchaseDetailRemoveService;
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