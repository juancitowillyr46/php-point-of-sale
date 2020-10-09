<?php
namespace App\BackOffice\Permissions\Domain\Entities;

use App\BackOffice\Permissions\Domain\Exceptions\PermissionActionRequestSchema;
use App\Shared\Domain\Entities\Audit;
use Exception;

class PermissionEntity extends Audit
{
    public string $name;
    public string $slug;
    public string $icon;
    public int $parent_id;
    public bool $is_parent;
    public bool $is_children;
    public int $order;


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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     */
    public function setParentId(int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return bool
     */
    public function isIsParent(): bool
    {
        return $this->is_parent;
    }

    /**
     * @param bool $is_parent
     */
    public function setIsParent(bool $is_parent): void
    {
        $this->is_parent = $is_parent;
    }

    /**
     * @return bool
     */
    public function isIsChildren(): bool
    {
        return $this->is_children;
    }

    /**
     * @param bool $is_children
     */
    public function setIsChildren(bool $is_children): void
    {
        $this->is_children = $is_children;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order): void
    {
        $this->order = $order;
    }



    public function payload(object $formData): void {

        try {

            $validate = new PermissionActionRequestSchema();
            $validate->getMessages((array) $formData);

            $this->identifiedResource($formData);

            $this->setName($formData->name);
            $this->setIcon($formData->icon);
            $this->setSlug($formData->slug);
            $this->setIsParent($formData->isParent);
            $this->setIsChildren($formData->isChildren);
            $this->setOrder($formData->order);
            $this->setActive($formData->active);

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}