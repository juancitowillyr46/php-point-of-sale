<?php
namespace App\BackOffice\Roles\Application\Actions;

use App\BackOffice\Roles\Domain\Services\RoleAddService;
use App\BackOffice\Roles\Domain\Services\RoleEditService;
use App\BackOffice\Roles\Domain\Services\RoleFindAllService;
use App\BackOffice\Roles\Domain\Services\RoleFindService;
use App\BackOffice\Roles\Domain\Services\RoleRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class RoleAction extends Action
{
    public RoleAddService $roleAddService;
    public RoleEditService $roleEditService;
    public RoleFindService $roleFindService;
    public RoleFindAllService $roleFindAllService;
    public RoleRemoveService $roleRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        RoleAddService $roleAddService,
        RoleEditService $roleEditService,
        RoleFindService $roleFindService,
        RoleFindAllService $roleFindAllService,
        RoleRemoveService $roleRemoveService
    )
    {
        $this->roleAddService = $roleAddService;
        $this->roleEditService = $roleEditService;
        $this->roleFindService = $roleFindService;
        $this->roleFindAllService = $roleFindAllService;
        $this->roleRemoveService = $roleRemoveService;
        parent::__construct($logger);
    }
}

