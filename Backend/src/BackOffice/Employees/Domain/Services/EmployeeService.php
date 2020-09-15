<?php
namespace App\BackOffice\Employees\Domain\Services;

use App\BackOffice\Employees\Domain\Entities\EmployeeEntity;
use App\BackOffice\Employees\Domain\Entities\EmployeeMapper;
use App\BackOffice\Employees\Infrastructure\Persistence\EmployeeRepository;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class EmployeeService extends BaseService
{

    protected EmployeeEntity $EmployeeEntity;
    protected EmployeeRepository $EmployeeRepository;
    protected EmployeeMapper $EmployeeMapper;

    public function __construct(EmployeeRepository $EmployeeRepository, EmployeeEntity $EmployeeEntity, EmployeeMapper $EmployeeMapper)
    {
        $this->EmployeeRepository = $EmployeeRepository;
        $this->EmployeeEntity = $EmployeeEntity;
        $this->EmployeeMapper = $EmployeeMapper;
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
}