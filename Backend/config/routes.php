<?php declare(strict_types=1);

use Slim\App;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (App $app) {
    $app->get('/', function (ServerRequest $request, Response $response, $args){
        $message = array(
            "message" => "REST API v1.0.0",
            "data" => "Hello World"
        );
        return $response->withJson($message);
    });
};