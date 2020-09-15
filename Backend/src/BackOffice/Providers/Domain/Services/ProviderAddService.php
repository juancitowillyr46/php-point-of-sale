<?php
namespace App\BackOffice\Providers\Domain\Services;

use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class ProviderAddService extends ProviderService
{

    public function execute(object $bodyParsed): object
    {
        try {

            $this->ProviderEntity->payload($bodyParsed);
            $success = $this->ProviderRepository->addProvider(((array) $this->ProviderEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->ProviderEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}