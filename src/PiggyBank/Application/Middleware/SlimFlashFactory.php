<?php

declare(strict_types=1);

namespace PiggyBank\Application\Middleware;

use Slim\Flash\Messages;

class SlimFlashFactory
{
    public function __invoke($request, $response, $next)
    {
        // Start the session whenever we use this!
        session_start();

        return $next(
            $request->withAttribute('flash', new Messages()),
            $response
        );
    }
}
