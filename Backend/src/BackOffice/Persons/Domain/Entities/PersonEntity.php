<?php
namespace App\BackOffice\Persons\Domain\Entities;

use App\BackOffice\Persons\Domain\Exceptions\PersonActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class PersonEntity extends Audit
{
    public string $email;
    public string $first_name;
    public string $last_name;
    public string $home_phone_number;
    public string $cell_phone_number;
    public string $document_num;
    public int $document_type;

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
     * @return string
     */
    public function getDocumentNum(): string
    {
        return $this->document_num;
    }

    /**
     * @param string $document_num
     */
    public function setDocumentNum(string $document_num): void
    {
        $this->document_num = $document_num;
    }

    /**
     * @return int
     */
    public function getDocumentType(): int
    {
        return $this->document_type;
    }

    /**
     * @param int $document_type
     */
    public function setDocumentType(int $document_type): void
    {
        $this->document_type = $document_type;
    }




    public function payload(object $formData): void {

        try {

            $validate = new PersonActionRequestSchema();
            $validate->getMessages((array) $formData);

            $this->identifiedResource($formData);

            $this->setFirstName($formData->firstName);
            $this->setLastName($formData->lastName);
            $this->setEmail($formData->email);
            $this->setCellPhoneNumber($formData->cellPhoneNumber);
            $this->setHomePhoneNumber($formData->homePhoneNumber);
            $this->setDocumentNum($formData->documentNum);

            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}