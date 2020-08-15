<?php
namespace App\BackOffice\Products\Domain\Entities;

use App\Shared\Domain\Entities\Audit;

class Product extends Audit
{
    public string $name;
    public string $description;
    public int  $id_category;
    public int  $id_unit_measurent;
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
    public function getIdCategory(): int
    {
        return $this->id_category;
    }

    /**
     * @param int $id_category
     */
    public function setIdCategory(int $id_category): void
    {
        $this->id_category = $id_category;
    }

    /**
     * @return int
     */
    public function getIdUnitMeasurent(): int
    {
        return $this->id_unit_measurent;
    }

    /**
     * @param int $id_unit_measurent
     */
    public function setIdUnitMeasurent(int $id_unit_measurent): void
    {
        $this->id_unit_measurent = $id_unit_measurent;
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



}