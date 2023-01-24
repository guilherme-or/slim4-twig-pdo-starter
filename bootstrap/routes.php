<?php

use Slim\Routing\RouteCollectorProxy;

use App\Controllers\UsuarioController;
use App\Controllers\HomeController;

return function (Slim\App $app): void {    
    $app->group('/', function (RouteCollectorProxy $group) {
        $group->get('[{name}]', [HomeController::class, 'home'])->setName('home');
    });
};
