<?php
namespace App\BackOffice\Ubigeo\Domain\Repository;

interface UbigeoRepositoryInterface
{
    public function addUbigeo(array $ubigeo): bool;

    public function editUbigeo(int $id, array $ubigeo): bool;

    public function findUbigeo(int $id): array;

    public function removeUbigeo(int $id): bool;

    public function allUbigeo(array $query): object;

    public function commonUbigeoDepartments(): array;

    public function commonUbigeoProvinces(int $department_id): array;

    public function commonUbigeoDistricts(int $department_id, int $province_id): array;
}