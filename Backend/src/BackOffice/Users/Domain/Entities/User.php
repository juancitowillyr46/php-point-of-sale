<?php
namespace App\BackOffice\Users\Domain\Entities;

use App\Shared\Domain\Entities\Audit;

class User extends Audit
{
    public string $username;
    public string $password;
    public string $user_type_uuid;
    public int $user_type_id;
    public string $email;


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
    public function getUserTypeUuid(): string
    {
        return $this->user_type_uuid;
    }

    /**
     * @param string $user_type_uuid
     */
    public function setUserTypeUuid(string $user_type_uuid): void
    {
        $this->user_type_uuid = $user_type_uuid;
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

}