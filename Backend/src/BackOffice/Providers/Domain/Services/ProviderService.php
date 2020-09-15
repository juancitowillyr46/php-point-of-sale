<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderEntity;
use App\BackOffice\Providers\Domain\Entities\ProviderMapper;
use App\BackOffice\Providers\Infrastructure\Persistence\ProviderRepository;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class ProviderService extends BaseService
{

    protected ProviderEntity $ProviderEntity;
    protected ProviderRepository $ProviderRepository;
    protected ProviderMapper $ProviderMapper;

    public function __construct(ProviderRepository $ProviderRepository, ProviderEntity $ProviderEntity, ProviderMapper $ProviderMapper)
    {
        $this->ProviderRepository = $ProviderRepository;
        $this->ProviderEntity = $ProviderEntity;
        $this->ProviderMapper = $ProviderMapper;
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