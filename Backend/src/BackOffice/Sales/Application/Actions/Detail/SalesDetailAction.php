<?php
namespace App\BackOffice\Sales\Application\Actions\Detail;

use App\BackOffice\Sales\Domain\Services\Detail\SaleDetailAddService;
use App\BackOffice\Sales\Domain\Services\Detail\SaleDetailEditService;
use App\BackOffice\Sales\Domain\Services\Detail\SaleDetailFindAllService;
use App\BackOffice\Sales\Domain\Services\Detail\SaleDetailFindService;
use App\BackOffice\Sales\Domain\Services\Detail\SaleDetailRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class SalesDetailAction extends Action
{
    public SaleDetailAddService $saleDetailAddService;
    public SaleDetailEditService $saleDetailEditService;
    public SaleDetailFindService $saleDetailFindService;
    public SaleDetailFindAllService $saleDetailFindAllService;
    public SaleDetailRemoveService $saleDetailRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        SaleDetailAddService $saleDetailAddService,
        SaleDetailEditService $saleDetailEditService,
        SaleDetailFindService $saleDetailFindService,
        SaleDetailFindAllService $saleDetailFindAllService,
        SaleDetailRemoveService $saleDetailRemoveService
    )
    {
        $this->saleDetailAddService = $saleDetailAddService;
        $this->saleDetailEditService = $saleDetailEditService;
        $this->saleDetailFindService = $saleDetailFindService;
        $this->saleDetailFindAllService = $saleDetailFindAllService;
        $this->saleDetailRemoveService = $saleDetailRemoveService;
        parent::__construct($logger);
    }
}