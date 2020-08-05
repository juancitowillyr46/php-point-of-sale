<?php
namespace App\BackOffice\Users\Domain\Entities;

class User
{
    protected int $id;
    protected string $uuid;
    protected string $username;
    protected string $password;
    protected string $type_user;
    protected int $type_user_id;
    protected string $email;
    protected bool $active;
    protected string $created_at;
    protected string $created_by;
    protected string $updated_at;
    protected string $updated_by;
    protected string $deleted_at;
    protected string $deleted_by;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
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
    public function getTypeUser(): string
    {
        return $this->type_user;
    }

    /**
     * @param string $type_user
     */
    public function setTypeUser(string $type_user): void
    {
        $this->type_user = $type_user;
    }

    /**
     * @return int
     */
    public function getTypeUserId(): int
    {
        return $this->type_user_id;
    }

    /**
     * @param int $type_user_id
     */
    public function setTypeUserId(int $type_user_id): void
    {
        $this->type_user_id = $type_user_id;
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
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->created_by;
    }

    /**
     * @param string $created_by
     */
    public function setCreatedBy(string $created_by): void
    {
        $this->created_by = $created_by;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getUpdatedBy(): string
    {
        return $this->updated_by;
    }

    /**
     * @param string $updated_by
     */
    public function setUpdatedBy(string $updated_by): void
    {
        $this->updated_by = $updated_by;
    }

    /**
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deleted_at;
    }

    /**
     * @param string $deleted_at
     */
    public function setDeletedAt(string $deleted_at): void
    {
        $this->deleted_at = $deleted_at;
    }

    /**
     * @return string
     */
    public function getDeletedBy(): string
    {
        return $this->deleted_by;
    }

    /**
     * @param string $deleted_by
     */
    public function setDeletedBy(string $deleted_by): void
    {
        $this->deleted_by = $deleted_by;
    }

}