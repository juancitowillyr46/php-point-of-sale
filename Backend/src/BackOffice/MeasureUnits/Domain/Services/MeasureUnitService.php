<?php
namespace App\BackOffice\MeasureUnits\Domain\Services;

use App\BackOffice\MeasureUnits\Domain\Entities\MeasureUnit;
use App\BackOffice\MeasureUnits\Domain\Entities\MeasureUnitDto;
use App\BackOffice\MeasureUnits\Domain\Entities\MeasureUnitMapper;
use App\BackOffice\MeasureUnits\Infrastructure\Persistence\MeasureUnitRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class MeasureUnitService extends BaseService
{
    public MeasureUnitMapper $mapper;
    public MeasureUnit $measureUnit;
    public MeasureUnitRepository $repository;

    public function __construct(MeasureUnitMapper $mapper, MeasureUnitRepository $repository, MeasureUnit $measureUnit)
    {
        $this->mapper = $mapper;
        $this->measureUnit = $measureUnit;
        $this->repository = $repository;
        $this->setRepository($repository);
    }

    public function payLoad(object $request): array
    {

        try {

            $measureUnit = $this->measureUnit;

            if($request->uuid != "") {
                $measureUnit->setUuid($request->uuid);
            } else {
                $measureUnit->setUuid(UuidGenerate::uuid1());
            }

            $measureUnit->setDescription($request->description);
            $measureUnit->setName($request->name);
            $measureUnit->setActive($request->active);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        /* Ubicar el id del typeUserUuid */
        return (array) $measureUnit;
    }

    public function findToDto(string $uuid) {
        return $this->mapper->autoMapper->map($this->find($uuid), MeasureUnitDto::class);
    }

}