<?php
namespace App\BackOffice\Ubigeo\Domain\Entities;

use App\BackOffice\Ubigeo\Domain\Exceptions\UbigeoActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class UbigeoEntity extends Audit
{
    public string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }



    public function payload(object $formData): void {

        try {

            $validate = new UbigeoActionRequestSchema();
            $validate->getMessages((array) $formData);

            $this->identifiedResource($formData);

            $this->setName($formData->name);
            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}