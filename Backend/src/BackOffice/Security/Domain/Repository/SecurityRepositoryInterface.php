<?php
namespace App\BackOffice\Security\Domain\Repository;

interface SecurityRepositoryInterface
{

    public function searchUserByUsername(string $username): ?object;

}