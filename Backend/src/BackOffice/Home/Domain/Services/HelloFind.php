<?php


namespace App\BackOffice\Home\Domain\Services;


use App\BackOffice\Home\Domain\Repository\HelloRepository;

class HelloFind
{
    private HelloRepository $helloFindRepository;

    public function __construct(HelloRepository $helloFindRepository)
    {
        $this->helloFindRepository = $helloFindRepository;
    }

    public function getHello() {
//        $this->helloFindRepository->getHello();
    }

}