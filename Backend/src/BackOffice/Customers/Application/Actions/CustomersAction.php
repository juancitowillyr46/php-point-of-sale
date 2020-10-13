<?php
namespace App\BackOffice\Customers\Application\Actions;

use App\BackOffice\Customers\Domain\Services\CustomerAddService;
use App\BackOffice\Customers\Domain\Services\CustomerEditService;
use App\BackOffice\Customers\Domain\Services\CustomerFindAllService;
use App\BackOffice\Customers\Domain\Services\CustomerFindService;
use App\BackOffice\Customers\Domain\Services\CustomerRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class CustomersAction extends Action
{
    public CustomerAddService $customerAddService;
    public CustomerEditService $customerEditService;
    public CustomerFindService $customerFindService;
    public CustomerFindAllService $customerFindAllService;
    public CustomerRemoveService $customerRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        CustomerAddService $customerAddService,
        CustomerEditService $customerEditService,
        CustomerFindService $customerFindService,
        CustomerFindAllService $customerFindAllService,
        CustomerRemoveService $customerRemoveService
    )
    {
        $this->customerAddService = $customerAddService;
        $this->customerEditService = $customerEditService;
        $this->customerFindService = $customerFindService;
        $this->customerFindAllService = $customerFindAllService;
        $this->customerRemoveService = $customerRemoveService;
        parent::__construct($logger);
    }
}

