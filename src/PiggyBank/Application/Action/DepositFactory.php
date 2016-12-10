<?php

declare(strict_types=1);

namespace PiggyBank\Application\Action;

use Interop\Container\ContainerInterface;

class DepositFactory
{
    public function __invoke(ContainerInterface $container)
    {

        $router = $container->get('router');
        $template = $container->get('template');

        return new Deposit($router, $template);
    }
}

