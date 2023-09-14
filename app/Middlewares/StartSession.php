<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Utils\Session;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class StartSession implements Middleware
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        $request = $request->withAttribute('session', (new Session())->get());
        return $handler->handle($request);
    }
}
