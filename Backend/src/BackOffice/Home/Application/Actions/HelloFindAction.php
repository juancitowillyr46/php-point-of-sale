<?php


namespace App\BackOffice\Home\Application\Actions;


use App\BackOffice\Home\Domain\Services\HelloFind;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class HelloFindAction extends HomeAction
{
    private HelloFind $helloFind;

    public function __construct(LoggerInterface $logger, HelloFind $helloFind)
    {
        $this->helloFind = $helloFind;
        parent::__construct($logger);
    }

    protected function action(): Response
    {
        $this->logger->info('Consultando....');
        return $this->respondWithData(array("Hello" => "World"));
    }
}