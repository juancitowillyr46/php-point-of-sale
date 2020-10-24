<?php
namespace App\BackOffice\Sales\Application\Actions;

use App\BackOffice\Sales\Domain\Services\SaleAddService;
use App\BackOffice\Sales\Domain\Services\SaleEditService;
use App\BackOffice\Sales\Domain\Services\SaleFindAllService;
use App\BackOffice\Sales\Domain\Services\SaleFindService;
use App\BackOffice\Sales\Domain\Services\SaleRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class SalesAction extends Action
{
    public SaleAddService $saleAddService;
    public SaleEditService $saleEditService;
    public SaleFindService $saleFindService;
    public SaleFindAllService $saleFindAllService;
    public SaleRemoveService $saleRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        SaleAddService $saleAddService,
        SaleEditService $saleEditService,
        SaleFindService $saleFindService,
        SaleFindAllService $saleFindAllService,
        SaleRemoveService $saleRemoveService
    )
    {
        $this->saleAddService = $saleAddService;
        $this->saleEditService = $saleEditService;
        $this->saleFindService = $saleFindService;
        $this->saleFindAllService = $saleFindAllService;
        $this->saleRemoveService = $saleRemoveService;
        parent::__construct($logger);
    }
}

