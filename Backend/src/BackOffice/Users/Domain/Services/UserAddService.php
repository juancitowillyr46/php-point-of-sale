<?php
namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Infrastructure\Persistence\UserRepository;

class UserAddService
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function createUserFromArray() {
        //$this->userRepository->find()
    }

}