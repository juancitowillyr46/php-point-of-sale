<?php
namespace App\BackOffice\Persons\Domain\Services;

use App\BackOffice\Persons\Domain\Entities\PersonEntity;
use App\BackOffice\Persons\Domain\Entities\PersonMapper;
use App\BackOffice\Persons\Infrastructure\Persistence\PersonRepository;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\Commands\DuplicateActionException;
use stdClass;

class PersonService extends BaseService
{

    protected PersonEntity $personEntity;
    protected PersonRepository $personRepository;
    protected PersonMapper $personMapper;

    public function __construct(PersonRepository $personRepository, PersonEntity $personEntity, PersonMapper $personMapper)
    {
        $this->personRepository = $personRepository;
        $this->personEntity = $personEntity;
        $this->personMapper = $personMapper;
    }

    public function validateDuplicate(string $documentNum, string $uuid): void {

        $existDocumentNum = $this->personRepository->findByAttr('document_num', $documentNum, $uuid);
        if($existDocumentNum) {
            throw new DuplicateActionException();
        }

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