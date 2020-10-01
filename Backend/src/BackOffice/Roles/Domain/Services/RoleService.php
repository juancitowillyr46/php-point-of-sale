<?php
namespace App\BackOffice\Roles\Domain\Services;

use App\BackOffice\Roles\Domain\Entities\RoleEntity;
use App\BackOffice\Roles\Domain\Entities\RoleMapper;
use App\BackOffice\Roles\Infrastructure\Persistence\RoleRepository;
use App\Shared\Domain\Entities\CommonMapper;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class RoleService extends BaseService
{

    protected RoleEntity $roleEntity;
    protected RoleRepository $roleRepository;
    protected RoleMapper $roleMapper;
    protected CommonMapper $commonMapper;

    public function __construct(RoleRepository $roleRepository, RoleEntity $roleEntity, RoleMapper $roleMapper, CommonMapper $commonMapper)
    {
        $this->roleRepository = $roleRepository;
        $this->roleEntity = $roleEntity;
        $this->roleMapper = $roleMapper;
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