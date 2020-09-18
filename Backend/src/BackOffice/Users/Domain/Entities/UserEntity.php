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
    public int $user_type_id;
    public string $email;
    public bool $blocked;

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
     * @return int
     */
    public function getUserTypeId(): int
    {
        return $this->user_type_id;
    }

    /**
     * @param int $user_type_id
     */
    public function setUserTypeId(int $user_type_id): void
    {
        $this->user_type_id = $user_type_id;
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

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}