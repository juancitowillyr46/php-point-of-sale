<?php


namespace App\Shared\Domain\Entities;


use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid as UuidGenerate;

class Audit
{
    public string $uuid;
    public int $id;
    public string $created_at;
    public string $created_by;
    public string $updated_at;
    public string $updated_by;
    public string $deleted_at;
    public string $deleted_by;
    public bool $active;


    public function __construct()
    {
        $this->setId(0);
        $this->setActive(true);
        $this->setCreatedAt(Chronos::now()->format("Y-m-d h:m:s"));
        $this->setCreatedBy('ADMIN');
        $this->setUpdatedAt('');
        $this->setUpdatedBy('');
        $this->setDeletedAt('');
        $this->setDeletedBy('');
        $this->setUuid(UuidGenerate::uuid1());
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



}