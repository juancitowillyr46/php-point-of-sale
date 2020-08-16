<?php
namespace App\BackOffice\DataMaster\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMaster;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterDto;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterMapper;
use App\BackOffice\DataMaster\Infrastructure\Persistence\DataMasterRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class DataMasterService extends BaseService
{
    public DataMasterMapper $mapper;
    public DataMaster $dataMaster;
    public DataMasterRepository $repository;

    public function __construct(DataMasterMapper $mapper, DataMasterRepository $repository, DataMaster $dataMaster)
    {
        $this->mapper = $mapper;
        $this->dataMaster = $dataMaster;
        $this->repository = $repository;
        $this->setRepository($repository);
    }

    public function payLoad(object $request): array
    {

        try {

            $dataMaster = $this->dataMaster;

            if($request->uuid != "") {
                $dataMaster->setUuid($request->uuid);
            } else {
                $dataMaster->setUuid(UuidGenerate::uuid1());
            }

            $dataMaster->setDescription($request->description);
            $dataMaster->setName($request->name);
            $dataMaster->setActive($request->active);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        /* Ubicar el id del typeUserUuid */
        return (array) $dataMaster;
    }

    public function findToDto(string $uuid) {
        return $this->mapper->autoMapper->map($this->find($uuid), DataMasterDto::class);
    }

}