<?php

use Slim\Factory\AppFactory;

/** @var Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/container.php';

AppFactory::setContainer($container);
$app = AppFactory::create();

$settings = $container->get('settings');
define('BASE_PATH', $settings['app']['path']);

$app->setBasePath(BASE_PATH);

return $app;
