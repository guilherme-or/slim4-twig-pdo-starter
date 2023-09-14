<?php

use Slim\Factory\AppFactory;

/** @var Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/container.php';

AppFactory::setContainer($container);
$app = AppFactory::create();

$settings = $container->get('settings');
if ($settings['app']['path'] != "") {
    $app->setBasePath($settings['app']['path']);
}

return $app;
