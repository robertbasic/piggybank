<?php

declare(strict_types=1);

namespace PiggyBank\Application\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Flash\Messages;

class FlashMessages implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        // Start the session whenever we use this!
        session_start();

        $response = $delegate->process($request->withAttribute('flash', new Messages()));

        return $response;
    }
}
