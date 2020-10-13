<?php
namespace App\BackOffice\Ubigeo\Application\Actions;

use App\BackOffice\Ubigeo\Domain\Services\UbigeoAddService;
use App\BackOffice\Ubigeo\Domain\Services\UbigeoEditService;
use App\BackOffice\Ubigeo\Domain\Services\UbigeoFindAllService;
use App\BackOffice\Ubigeo\Domain\Services\UbigeoFindService;
use App\BackOffice\Ubigeo\Domain\Services\UbigeoRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class UbigeoAction extends Action
{
    public UbigeoAddService $ubigeoAddService;
    public UbigeoEditService $ubigeoEditService;
    public UbigeoFindService $ubigeoFindService;
    public UbigeoFindAllService $ubigeoFindAllService;
    public UbigeoRemoveService $ubigeoRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        UbigeoAddService $ubigeoAddService,
        UbigeoEditService $ubigeoEditService,
        UbigeoFindService $ubigeoFindService,
        UbigeoFindAllService $ubigeoFindAllService,
        UbigeoRemoveService $ubigeoRemoveService
    )
    {
        $this->ubigeoAddService = $ubigeoAddService;
        $this->ubigeoEditService = $ubigeoEditService;
        $this->ubigeoFindService = $ubigeoFindService;
        $this->ubigeoFindAllService = $ubigeoFindAllService;
        $this->ubigeoRemoveService = $ubigeoRemoveService;
        parent::__construct($logger);
    }
}

