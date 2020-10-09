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
    public ProviderAddService $providerAddService;
    public ProviderEditService $providerEditService;
    public ProviderFindService $providerFindService;
    public ProviderFindAllService $providerFindAllService;
    public ProviderRemoveService $providerRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        ProviderAddService $providerAddService,
        ProviderEditService $providerEditService,
        ProviderFindService $providerFindService,
        ProviderFindAllService $providerFindAllService,
        ProviderRemoveService $providerRemoveService
    )
    {
        $this->providerAddService = $providerAddService;
        $this->providerEditService = $providerEditService;
        $this->providerFindService = $providerFindService;
        $this->providerFindAllService = $providerFindAllService;
        $this->providerRemoveService = $providerRemoveService;
        parent::__construct($logger);
    }
}

