<?php
declare(strict_types=1);

namespace App\BackOffice\Home\Application\Actions;


use Psr\Http\Message\ResponseInterface as Response;

final class HelloWorldAction extends HomeAction
{

    protected function action(): Response
    {
        $this->logger->info('Consultando....');
        return $this->respondWithData(array("Hello" => "World"));
    }
}