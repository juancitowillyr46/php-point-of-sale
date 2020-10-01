<?php
namespace App\BackOffice\Users\Domain\Entities;

use App\BackOffice\Users\Domain\Exceptions\UserActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use App\Shared\Utility\SecurityPassword;
use Exception;
use Ramsey\Uuid\Uuid;

class UserEntity extends Audit
{
    public string $username;
    public string $password;
    public int $role_id;
    public string $email;
    public bool $blocked;
    public string $first_name;
    public string $last_name;

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     */
    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
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
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->blocked;
    }

    /**
     * @param bool $blocked
     */
    public function setBlocked(bool $blocked): void
    {
        $this->blocked = $blocked;
    }



    public function payload(object $formData): void {

        try {

            $validate = new UserActionRequestSchema();
            $validate->getMessages((array)$formData);
            $this->identifiedResource($formData);
            $this->setPassword(SecurityPassword::encryptPassword($formData->password));
            $this->setUsername($formData->username);
            $this->setEmail($formData->email);
            $this->setActive($formData->active);
            $this->setBlocked($formData->blocked);
            $this->setFirstName($formData->firstName);
            $this->setLastName($formData->lastName);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}