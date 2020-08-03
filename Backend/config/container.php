<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    App::class => function (ContainerInterface $container){

        AppFactory::setContainer($container);
        /* Setting Connection DB */
//        $config = $container->get(Configuration::class);
//        $dbSettingsConnection = $config->getArray('db');

        /* Eloquent */
//        $capsule = new \Illuminate\Database\Capsule\Manager;
//        $capsule->addConnection($dbSettingsConnection);
//        $capsule->setAsGlobal();
//        $capsule->bootEloquent();

        return AppFactory::create();
    },
];