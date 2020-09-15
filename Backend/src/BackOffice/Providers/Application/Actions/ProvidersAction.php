<?php
namespace App\BackOffice\Providers\Application\Actions;

use App\BackOffice\Providers\Domain\Services\ProviderAddService;
use App\BackOffice\Providers\Domain\Services\ProviderEditService;
use App\BackOffice\Providers\Domain\Services\ProviderFindAllService;
use App\BackOffice\Providers\Domain\Services\ProviderFindService;
use App\BackOffice\Providers\Domain\Services\ProviderRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class ProvidersAction extends Action
{
    public ProviderAddService $ProviderAddService;
    public ProviderEditService $ProviderEditService;
    public ProviderFindService $ProviderFindService;
    public ProviderFindAllService $ProviderFindAllService;
    public ProviderRemoveService $ProviderRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        ProviderAddService $ProviderAddService,
        ProviderEditService $ProviderEditService,
        ProviderFindService $ProviderFindService,
        ProviderFindAllService $ProviderFindAllService,
        ProviderRemoveService $ProviderRemoveService
    )
    {
        $this->ProviderAddService = $ProviderAddService;
        $this->ProviderEditService = $ProviderEditService;
        $this->ProviderFindService = $ProviderFindService;
        $this->ProviderFindAllService = $ProviderFindAllService;
        $this->ProviderRemoveService = $ProviderRemoveService;
        parent::__construct($logger);
    }
}

