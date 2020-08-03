<?php declare(strict_types=1);

use Slim\App;
//use Slim\Http\Response;
//use Slim\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\BackOffice\Home\Application\Actions\HelloWorldAction;

return function (App $app) {
    $app->get('/', HelloWorldAction::class);
};