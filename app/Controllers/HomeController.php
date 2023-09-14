<?php

namespace App\Controllers;

use App\Utils\Abstracts\AbstractController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeController extends AbstractController
{
    public function home(Request $request, Response $response, $args): Response
    {
        $name = $args['name'] ?? 'world';
        return $this->render($response, 'home.html', ['name' => $name]);
    }
}
