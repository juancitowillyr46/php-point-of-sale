<?php
namespace App\BackOffice\Persons\Domain\Repository;

interface PersonRepositoryInterface
{
    public function addPerson(array $Person): bool;

    public function editPerson(int $id, array $userType): bool;

    public function findPerson(int $id): array;

    public function removePerson(int $id): bool;

    public function allPersons(array $query): array;
}