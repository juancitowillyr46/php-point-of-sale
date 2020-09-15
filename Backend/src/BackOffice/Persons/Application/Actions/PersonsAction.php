<?php
namespace App\BackOffice\Persons\Application\Actions;

use App\BackOffice\Persons\Domain\Services\PersonAddService;
use App\BackOffice\Persons\Domain\Services\PersonEditService;
use App\BackOffice\Persons\Domain\Services\PersonFindAllService;
use App\BackOffice\Persons\Domain\Services\PersonFindService;
use App\BackOffice\Persons\Domain\Services\PersonRemoveService;
use App\Shared\Action\Action;
use Psr\Log\LoggerInterface;

abstract class PersonsAction extends Action
{
    public PersonAddService $personAddService;
    public PersonEditService $personEditService;
    public PersonFindService $personFindService;
    public PersonFindAllService $personFindAllService;
    public PersonRemoveService $personRemoveService;

    public LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        PersonAddService $personAddService,
        PersonEditService $personEditService,
        PersonFindService $personFindService,
        PersonFindAllService $personFindAllService,
        PersonRemoveService $personRemoveService
    )
    {
        $this->personAddService = $personAddService;
        $this->personEditService = $personEditService;
        $this->personFindService = $personFindService;
        $this->personFindAllService = $personFindAllService;
        $this->personRemoveService = $personRemoveService;
        parent::__construct($logger);
    }
}

