<?php
namespace App\BackOffice\Products\Domain\Entities;

use App\BackOffice\Products\Domain\Exceptions\ProductActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class ProductEntity extends Audit
{
    public string $name;
    public string $description;
    public int $category_id;
    public int $provider_id;
    public int $unit_measurent_id;

    public string $code;


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
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return int
     */
    public function getProviderId(): int
    {
        return $this->provider_id;
    }

    /**
     * @param int $provider_id
     */
    public function setProviderId(int $provider_id): void
    {
        $this->provider_id = $provider_id;
    }

    /**
     * @return int
     */
    public function getUnitMeasurentId(): int
    {
        return $this->unit_measurent_id;
    }

    /**
     * @param int $unit_measurent_id
     */
    public function setUnitMeasurentId(int $unit_measurent_id): void
    {
        $this->unit_measurent_id = $unit_measurent_id;
    }



    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }


    public function payload(object $formData): void {

        try {

            $validate = new ProductActionRequestSchema();
            $validate->getMessages((array)$formData);
            $this->identifiedResource($formData);
            $this->setName($formData->name);
            $this->setDescription($formData->description);
            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }


}