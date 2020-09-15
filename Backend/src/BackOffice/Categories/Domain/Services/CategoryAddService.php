<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\Shared\Exception\Commands\AddActionException;
use Exception;
use stdClass;

class CategoryAddService extends CategoryService
{

    public function execute(object $bodyParsed): object
    {
        try {

            $this->categoryEntity->payload($bodyParsed);
            $success = $this->categoryRepository->addCategory(((array) $this->categoryEntity));
            if(!$success) {
                throw new AddActionException();
            }

            return $this->categoryEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}