<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeController extends AbstractController
{
    public function home(Request $request, Response $response, $args): Response
    {   
        $name = $args['name'] ?? 'world';
        return $this->render($response, 'home.twig', ['name' => $name]);
    }
}