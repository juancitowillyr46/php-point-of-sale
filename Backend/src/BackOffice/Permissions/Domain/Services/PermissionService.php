<?php
namespace App\BackOffice\Permissions\Domain\Services;

use App\BackOffice\Permissions\Domain\Entities\PermissionEntity;
use App\BackOffice\Permissions\Domain\Entities\PermissionMapper;
use App\BackOffice\Permissions\Infrastructure\Persistence\PermissionRepository;
use App\Shared\Domain\Entities\CommonMapper;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class PermissionService extends BaseService
{

    protected PermissionEntity $permissionEntity;
    protected PermissionRepository $permissionRepository;
    protected PermissionMapper $permissionMapper;
    protected CommonMapper $commonMapper;

    public function __construct(PermissionRepository $permissionRepository, PermissionEntity $permissionEntity, PermissionMapper $permissionMapper, CommonMapper $commonMapper)
    {
        $this->permissionRepository = $permissionRepository;
        $this->permissionEntity = $permissionEntity;
        $this->permissionMapper = $permissionMapper;
        $this->commonMapper = $commonMapper;
    }

    public function execute(object $bodyParsed): object
    {
        return new stdClass();
    }

    public function executeArg(string $uuid): object
    {
        return new stdClass();
    }

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object
    {
        return new stdClass();
    }

    public function executeCollection(array $query): array
    {
        return [];
    }

    public function executeCommon(): array
    {
        return [];
    }
}