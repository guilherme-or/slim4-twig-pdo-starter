<?php

use Slim\Routing\RouteCollectorProxy;

use App\Controllers\HomeController;

return function (Slim\App $app): void {    
    $app->group('/home', function (RouteCollectorProxy $group) {
        $group->get('[/{name}]', [HomeController::class, 'home'])->setName('home.name');
    });
};
