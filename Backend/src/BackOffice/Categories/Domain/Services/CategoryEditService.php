<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\Shared\Exception\Commands\EditActionException;
use Exception;

class CategoryEditService extends CategoryService
{

    public function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object {
        try {

            $this->findCompareIdWithArg($uuid, $bodyParsed->id);

            $findCategory = $this->findResourceByUuid(new CategoryModel(), $uuid);

            $this->categoryEntity->payload($bodyParsed);
            $success = $this->categoryRepository->editCategory($findCategory, ((array) $this->categoryEntity));
            if(!$success) {
                throw new EditActionException();
            }

            return $this->categoryEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}