<?php
namespace App\BackOffice\Providers\Domain\Entities;

use App\BackOffice\Providers\Domain\Exceptions\ProviderActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class ProviderEntity extends Audit
{
    public string $name;
    public string $ruc;
    public string $address;
    public int $department_id;
    public int $province_id;
    public int $district_id;
    public string $home_phone_number;
    public string $cell_phone_number;
    public string $description;
    public int $representative_id;

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
     * @return string
     */
    public function getRuc(): string
    {
        return $this->ruc;
    }

    /**
     * @param string $ruc
     */
    public function setRuc(string $ruc): void
    {
        $this->ruc = $ruc;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getDepartmentId(): string
    {
        return $this->department_id;
    }

    /**
     * @param string $department_id
     */
    public function setDepartmentId(string $department_id): void
    {
        $this->department_id = $department_id;
    }

    /**
     * @return string
     */
    public function getProvinceId(): string
    {
        return $this->province_id;
    }

    /**
     * @param string $province_id
     */
    public function setProvinceId(string $province_id): void
    {
        $this->province_id = $province_id;
    }

    /**
     * @return string
     */
    public function getDistrictId(): string
    {
        return $this->district_id;
    }

    /**
     * @param string $district_id
     */
    public function setDistrictId(string $district_id): void
    {
        $this->district_id = $district_id;
    }

    /**
     * @return string
     */
    public function getHomePhoneNumber(): string
    {
        return $this->home_phone_number;
    }

    /**
     * @param string $home_phone_number
     */
    public function setHomePhoneNumber(string $home_phone_number): void
    {
        $this->home_phone_number = $home_phone_number;
    }

    /**
     * @return string
     */
    public function getCellPhoneNumber(): string
    {
        return $this->cell_phone_number;
    }

    /**
     * @param string $cell_phone_number
     */
    public function setCellPhoneNumber(string $cell_phone_number): void
    {
        $this->cell_phone_number = $cell_phone_number;
    }

    /**
     * @return int
     */
    public function getRepresentativeId(): int
    {
        return $this->representative_id;
    }

    /**
     * @param int $representative_id
     */
    public function setRepresentativeId(int $representative_id): void
    {
        $this->representative_id = $representative_id;
    }


    public function payload(object $formData): void {

        try {

            $validate = new ProviderActionRequestSchema();
            $validate->getMessages((array) $formData);

            $this->identifiedResource($formData);

            $this->setName($formData->name);
            $this->setDescription($formData->description);
            $this->setRuc($formData->ruc);
            $this->setHomePhoneNumber($formData->homePhoneNumber);
            $this->setCellPhoneNumber($formData->cellPhoneNumber);
            $this->setAddress($formData->address);
            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}