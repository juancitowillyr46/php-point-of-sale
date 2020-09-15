<?php
namespace App\BackOffice\Persons\Domain\Services;

use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class PersonAddService extends PersonService
{
    public function execute(object $bodyParsed): object
    {
        try {

            $documentTypeId = $this->findResourceByUuidReturnIdRegister($bodyParsed->documentType);
            $this->personEntity->setDocumentType($documentTypeId);
            $this->personEntity->payload($bodyParsed);

            $this->validateDuplicate($bodyParsed->documentNum, $this->personEntity->getUuid());

            $success = $this->personRepository->addPerson(((array) $this->personEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->personEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}