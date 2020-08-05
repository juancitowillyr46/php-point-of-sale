<?php declare(strict_types=1);

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    Configuration::class => function() {
        return new Configuration(require __DIR__ . '/settings.php');
    },
    App::class => function (ContainerInterface $container){
        AppFactory::setContainer($container);
        return AppFactory::create();
    },
    LoggerInterface::class => function (ContainerInterface $c) {

        $config = $c->get(Configuration::class);

        $logger = new Logger($config->getString('logger.name'));

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($config->getString('logger.path'), $config->getInt('logger.level'));
        $logger->pushHandler($handler);

        return $logger;
    },
];