<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterEntity;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterMapper;
use App\BackOffice\DataMaster\Infrastructure\Persistence\DataMasterRepository;
use App\Shared\Domain\Entities\CommonMapper;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\Commands\DuplicateActionException;
use App\Shared\Exception\Commands\FindActionException;
use Exception;
use stdClass;

class DataMasterService extends BaseService
{
    protected DataMasterEntity $dataMasterEntity;
    protected DataMasterRepository $dataMasterRepository;
    protected DataMasterMapper $dataMasterMapper;
    protected CommonMapper $commonMapper;

    public function __construct(DataMasterRepository $dataMasterRepository, DataMasterEntity $dataMasterEntity, DataMasterMapper $dataMasterMapper, CommonMapper $commonMapper)
    {
        $this->dataMasterRepository = $dataMasterRepository;
        $this->dataMasterEntity = $dataMasterEntity;
        $this->dataMasterMapper = $dataMasterMapper;
        $this->commonMapper = $commonMapper;
    }

    public function validateDuplicate(string $type, int $idRegister, string $uuid): void {

        $existDocumentNum = $this->dataMasterRepository->validateIdRegister('id_register', $idRegister, $type, $uuid);
        if($existDocumentNum) {
            throw new DuplicateActionException();
        }

    }

    function execute(object $bodyParsed): object
    {
        return new stdClass();
    }

    function executeArg(string $uuid): object
    {
        return new stdClass();
    }

    function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object
    {
        return new stdClass();
    }

    function executeCollection(array $query): array
    {
        return [];
    }

    function getAssignedId(string $type): int {
        return $this->dataMasterRepository->getAssignedId($type);
    }
    
}