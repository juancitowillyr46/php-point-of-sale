<?php
namespace App\BackOffice\DataMaster\Domain\Repository;

interface DataMasterRepositoryInterface
{
    public function addDataMaster(array $dataMaster): bool;

    public function editDataMaster(int $id, array $dataMaster): bool;

    public function findDataMaster(int $id): array;

    public function removeDataMaster(int $id): bool;

    public function allDataMaster(array $query): object;

    public function commonData(string $type): array;

    public function getAssignedId(string $type): int;

    public function commonDataType(): array;
}