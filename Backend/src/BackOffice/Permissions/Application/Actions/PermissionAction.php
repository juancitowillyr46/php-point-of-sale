<?php
namespace App\BackOffice\Permissions\Application\Actions;

use App\BackOffice\Permissions\Domain\Services\PermissionAddService;
use App\BackOffice\Permissions\Domain\Services\PermissionEditService;
use App\BackOffice\Permissions\Domain\Services\PermissionFindAllService;
use App\BackOffice\Permissions\Domain\Services\PermissionFindService;
use App\BackOffice\Permissions\Domain\Services\PermissionRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class PermissionAction extends Action
{
    public PermissionAddService $permissionAddService;
    public PermissionEditService $permissionEditService;
    public PermissionFindService $permissionFindService;
    public PermissionFindAllService $permissionFindAllService;
    public PermissionRemoveService $permissionRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        PermissionAddService $permissionAddService,
        PermissionEditService $permissionEditService,
        PermissionFindService $permissionFindService,
        PermissionFindAllService $permissionFindAllService,
        PermissionRemoveService $permissionRemoveService
    )
    {
        $this->permissionAddService = $permissionAddService;
        $this->permissionEditService = $permissionEditService;
        $this->permissionFindService = $permissionFindService;
        $this->permissionFindAllService = $permissionFindAllService;
        $this->permissionRemoveService = $permissionRemoveService;
        parent::__construct($logger);
    }
}

