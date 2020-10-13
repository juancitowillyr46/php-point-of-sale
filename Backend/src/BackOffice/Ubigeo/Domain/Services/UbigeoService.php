<?php
namespace App\BackOffice\Ubigeo\Domain\Services;

use App\BackOffice\Ubigeo\Domain\Entities\UbigeoEntity;
use App\BackOffice\Ubigeo\Domain\Entities\UbigeoMapper;
use App\BackOffice\Ubigeo\Infrastructure\Persistence\UbigeoRepository;
use App\Shared\Domain\Entities\CommonMapper;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class UbigeoService extends BaseService
{

    protected UbigeoEntity $ubigeoEntity;
    protected UbigeoRepository $ubigeoRepository;
    protected UbigeoMapper $ubigeoMapper;
    protected CommonMapper $commonMapper;

    public function __construct(UbigeoRepository $ubigeoRepository, UbigeoEntity $ubigeoEntity, UbigeoMapper $ubigeoMapper, CommonMapper $commonMapper)
    {
        $this->ubigeoRepository = $ubigeoRepository;
        $this->ubigeoEntity = $ubigeoEntity;
        $this->ubigeoMapper = $ubigeoMapper;
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