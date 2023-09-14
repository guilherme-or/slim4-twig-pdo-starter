<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createMutable(__DIR__ . "/../");
try {
    $dotenv->load();
} catch (Exception $e) {
    $envExamplePath = realpath(__DIR__ . '/../.env.example');
    $envExamplePath = !$envExamplePath ? '.env.example' : $envExamplePath;
    die("CONFIG ERROR: Check or create a \".env\" file based on \"$envExamplePath\" configuration file in your project root");
}

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
        'engine' => $_ENV['DB_ENGINE'] == "" ? 'mysql' : $_ENV['DB_ENGINE'],
        'path' => $_ENV['DB_PATH'],
        'name' => $_ENV['DB_NAME'],
        'host' => $_ENV['DB_HOST'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
