<?php

return [
    'app' => [
        'name'   => 'Slim-4, Twig and PDO Starter',
        'path'   => '/slim4-twig-pdo-starter',
        'env'    => 'development',
        'debug'  => true,
        'locale' => 'en',
    ],
    'view' => [
        'path'  => __DIR__ . '/../app/Views',
        'cache' => __DIR__ . '/../var/cache'
    ],
    'database' => [
        'name' => 'test_database',
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
    ]
];
