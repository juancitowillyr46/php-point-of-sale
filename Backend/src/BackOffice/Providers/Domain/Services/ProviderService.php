<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\BackOffice\Providers\Domain\Entities\ProviderCommonMapper;
use App\BackOffice\Providers\Domain\Entities\ProviderEntity;
use App\BackOffice\Providers\Domain\Entities\ProviderMapper;
use App\BackOffice\Providers\Infrastructure\Persistence\ProviderRepository;
use App\Shared\Domain\Entities\CommonMapper;
use App\Shared\Domain\Services\BaseService;
use stdClass;

class ProviderService extends BaseService
{

    protected ProviderEntity $providerEntity;
    protected ProviderRepository $providerRepository;
    protected ProviderMapper $providerMapper;
    protected ProviderCommonMapper $providerCommonMapper;

    public function __construct(ProviderRepository $providerRepository, ProviderEntity $providerEntity, ProviderMapper $providerMapper, ProviderCommonMapper $providerCommonMapper)
    {
        $this->providerRepository = $providerRepository;
        $this->providerEntity = $providerEntity;
        $this->providerMapper = $providerMapper;
        $this->providerCommonMapper = $providerCommonMapper;
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