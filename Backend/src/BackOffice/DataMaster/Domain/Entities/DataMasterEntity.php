<?php
namespace App\BackOffice\DataMaster\Domain\Entities;

use App\BackOffice\DataMaster\Domain\Exceptions\DataMasterActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class DataMasterEntity extends Audit
{
    public int $id_register;
    public string $name;
    public string $description;
    public string $type;

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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getIdRegister(): int
    {
        return $this->id_register;
    }

    /**
     * @param int $id_register
     */
    public function setIdRegister(int $id_register): void
    {
        $this->id_register = $id_register;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function payload(object $formData): void {

        try {

            $validate = new DataMasterActionRequestSchema();
            $validate->getMessages((array)$formData);
            $this->identifiedResource($formData);
            $this->setName($formData->name);
            $this->setDescription($formData->description);
            $this->setType($formData->type);
            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

}