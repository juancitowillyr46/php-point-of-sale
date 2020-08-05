<?php
declare(strict_types=1);
use App\Shared\Middleware\AuthValidateTokenMiddleware;
use Slim\App;

return function (App $app) {
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->add(AuthValidateTokenMiddleware::class);
};