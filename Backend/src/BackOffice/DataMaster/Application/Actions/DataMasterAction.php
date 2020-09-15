<?php
namespace App\BackOffice\DataMaster\Application\Actions;

use App\BackOffice\DataMaster\Domain\Exceptions\DataMasterActionRequestSchema;
use App\BackOffice\DataMaster\Domain\Services\DataMasterAddService;
use App\BackOffice\DataMaster\Domain\Services\DataMasterEditService;
use App\BackOffice\DataMaster\Domain\Services\DataMasterFindAllService;
use App\BackOffice\DataMaster\Domain\Services\DataMasterFindService;
use App\BackOffice\DataMaster\Domain\Services\DataMasterRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class DataMasterAction extends Action
{
    public DataMasterAddService $dataMasterAddService;
    public DataMasterEditService $dataMasterEditService;
    public DataMasterFindService $dataMasterFindService;
    public DataMasterFindAllService $dataMasterFindAllService;
    public DataMasterRemoveService $dataMasterRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        DataMasterAddService $dataMasterAddService,
        DataMasterEditService $dataMasterEditService,
        DataMasterFindService $dataMasterFindService,
        DataMasterFindAllService $dataMasterFindAllService,
        DataMasterRemoveService $dataMasterRemoveService
    )
    {
        $this->dataMasterAddService = $dataMasterAddService;
        $this->dataMasterEditService = $dataMasterEditService;
        $this->dataMasterFindService = $dataMasterFindService;
        $this->dataMasterFindAllService = $dataMasterFindAllService;
        $this->dataMasterRemoveService = $dataMasterRemoveService;
        parent::__construct($logger);
    }
}

