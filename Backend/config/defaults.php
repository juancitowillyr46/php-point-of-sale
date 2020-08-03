<?php
declare(strict_types=1);

use Monolog\Logger;

error_reporting(0);
ini_set('display_errors', '0');

date_default_timezone_set('America/Lima');

$settings = [];

$settings['root'] = isset($_ENV['docker']) ? 'php://stdout' : __DIR__;

$settings['logger'] = [
    'name' => 'app',
    'path' => $settings['root'] . '/../logs/app.log',
    'filename' => 'app.log',
    'level' => Logger::DEBUG,
    'file_permission' => 0775,
];

return $settings;