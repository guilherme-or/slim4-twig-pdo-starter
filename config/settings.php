<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createMutable(__DIR__ . "/../");
$dotenv->load();

return [
    'app' => [
        'name'   => $_ENV['APP_NAME'],
        'path'   => $_ENV['BASE_PATH'],
        'debug'  => $_ENV['ENV'] == 'development' ? true : false,
    ],
    'view' => [
        'path'  => __DIR__ . '/../app/Views',
        'cache' => __DIR__ . '/../var/cache'
    ],
    'database' => [
        'name' => $_ENV['DB_NAME'],
        'host' => $_ENV['DB_HOST'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
