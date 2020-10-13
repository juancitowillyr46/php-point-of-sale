<?php
namespace App\BackOffice\Customers\Domain\Entities;

use App\BackOffice\Customers\Domain\Exceptions\CustomerActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class CustomerEntity extends Audit
{
    public string $business_name;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $home_phone_number;
    public string $cell_phone_number;
    public string $document_number;
    public int $document_type_id;
    public string $ruc;
    public string $address;
    public int $department_id;
    public int $province_id;
    public int $district_id;

    /**
     * @return int
     */
    public function getDocumentTypeId(): int
    {
        return $this->document_type_id;
    }

    /**
     * @param int $document_type_id
     */
    public function setDocumentTypeId(int $document_type_id): void
    {
        $this->document_type_id = $document_type_id;
    }

    /**
     * @return string
     */
    public function getBusinessName(): string
    {
        return $this->business_name;
    }

    /**
     * @param string $business_name
     */
    public function setBusinessName(string $business_name): void
    {
        $this->business_name = $business_name;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDocumentNumber(): string
    {
        return $this->document_number;
    }

    /**
     * @param string $document_number
     */
    public function setDocumentNumber(string $document_number): void
    {
        $this->document_number = $document_number;
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

    public function payload(object $formData): void {

        try {

            $validate = new CustomerActionRequestSchema();
            $validate->getMessages((array) $formData);

            $this->identifiedResource($formData);

            $this->setBusinessName($formData->businessName);
            $this->setFirstName($formData->firstName);
            $this->setLastName($formData->lastName);
            $this->setEmail($formData->email);
            $this->setHomePhoneNumber($formData->homePhoneNumber);
            $this->setCellPhoneNumber($formData->cellPhoneNumber);
            $this->setDocumentNumber($formData->documentNumber);

            $this->setRuc($formData->ruc);
            $this->setAddress($formData->address);
            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}