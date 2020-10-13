<?php
namespace App\BackOffice\Customers\Domain\Services;

use App\BackOffice\Customers\Domain\Entities\CustomerCommonMapper;
use App\BackOffice\Customers\Domain\Entities\CustomerEntity;
use App\BackOffice\Customers\Domain\Entities\CustomerMapper;
use App\BackOffice\Customers\Infrastructure\Persistence\CustomerRepository;
use App\Shared\Domain\Entities\CommonMapper;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class CustomerService extends BaseService
{

    protected CustomerEntity $customerEntity;
    protected CustomerRepository $customerRepository;
    protected CustomerMapper $customerMapper;
    protected CustomerCommonMapper $customerCommonMapper;

    public function __construct(CustomerRepository $customerRepository, CustomerEntity $customerEntity, CustomerMapper $customerMapper, CustomerCommonMapper $customerCommonMapper)
    {
        $this->customerRepository = $customerRepository;
        $this->customerEntity = $customerEntity;
        $this->customerMapper = $customerMapper;
        $this->customerCommonMapper = $customerCommonMapper;
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