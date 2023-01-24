<?php

use App\Middlewares\StartSession;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function (App $app): void {
    $app->addRoutingMiddleware();
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware(true, true, true);
    $app->add(TwigMiddleware::createFromContainer($app, Twig::class));
    $app->add(new StartSession());
};
