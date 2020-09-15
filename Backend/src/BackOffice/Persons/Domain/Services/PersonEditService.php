<?php
namespace App\BackOffice\Persons\Domain\Services;

use App\BackOffice\Persons\Domain\Entities\PersonModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class PersonEditService extends PersonService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findPerson = $this->findResourceByUuid(new PersonModel(), $uuid);

            $documentTypeId = $this->findResourceByUuidReturnIdRegister($bodyParsed->documentType);
            $this->personEntity->setDocumentType($documentTypeId);
            $this->personEntity->payload($bodyParsed);

            $this->validateDuplicate($bodyParsed->documentNum, $this->personEntity->getUuid());

            $this->personEntity->payload($bodyParsed);
            $success = $this->personRepository->editPerson($findPerson, ((array) $this->personEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->personEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}