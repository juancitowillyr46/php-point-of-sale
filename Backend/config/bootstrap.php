<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(true);
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

try {
    $container = $containerBuilder->build();
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

try {
    $app = $container->get(App::class);
} catch (\DI\DependencyException $e) {
    throw new Exception($e->getMessage());
} catch (\DI\NotFoundException $e) {
    throw new Exception($e->getMessage());
}

(require __DIR__ . '/routes.php')($app);

return $app;

