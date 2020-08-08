<?php
declare(strict_types=1);

use Slim\App;
//use Slim\Http\Response;
//use Slim\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\BackOffice\Home\Application\Actions\HelloWorldAction;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', HelloWorldAction::class);

    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->group('/users', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Users\Application\Actions\AddUserAction::class);
            $group->get('/{uuid}', \App\BackOffice\Users\Application\Actions\FindUserAction::class);
            $group->get('/', \App\BackOffice\Users\Application\Actions\FindUserAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Users\Application\Actions\EditUserAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Users\Application\Actions\RemoveUserAction::class);
        });
    });

};